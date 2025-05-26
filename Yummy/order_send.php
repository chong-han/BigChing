<?php
// 資料庫設定
// 確保 db_connection.php 建立了 PDO 連線
include("db_connection.php"); //

// 檢查所有必要的 POST 資料是否都已接收
// 包括了基本資料和所有自定義選項
if (
    !isset(
        $_POST['name'],
        $_POST['phone'],
        $_POST['item_name'],
        $_POST['spiciness'],
        $_POST['flavor'],
        $_POST['preparation'],
        $_POST['scallion_option'],
        $_POST['pickled_cabbage_option']
    )
) {
    die("資料不完整，請確保所有必要欄位都已填寫。");
}

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = !empty($_POST['email']) ? $_POST['email'] : null;
$payment = $_POST['payment'] ?? ''; // 如果有支付相關欄位
$cartTotal = $_POST['cart_total'] ?? 0; // 如果有購物車總價

$itemNames = $_POST['item_name'];
$itemPrices = $_POST['item_price'];
$itemQtys = $_POST['item_qty'];

// 獲取自定義選項的值
$spiciness = $_POST['spiciness'];
$flavor = $_POST['flavor'];
$preparation = $_POST['preparation'];
$scallion_option = $_POST['scallion_option'];
$pickled_cabbage_option = $_POST['pickled_cabbage_option'];

// 將所有自定義選項整合成一個備註字串
$orderRemarks = "辣度: {$spiciness}, 口味: {$flavor}, 作法: {$preparation}, 蔥: {$scallion_option}, 酸菜: {$pickled_cabbage_option}";

$pdo->beginTransaction();

try {
    // ✅ 查詢是否已有該顧客
    $stmt = $pdo->prepare("SELECT Customer_ID FROM customer WHERE Customer_name = ? AND Customer_phone = ?");
    $stmt->execute([$name, $phone]);
    $customer = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($customer) {
        $customerId = $customer['Customer_ID'];
    } else {
        $stmt = $pdo->prepare("INSERT INTO customer (Customer_name, Customer_mail, Customer_phone) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $phone]);
        $customerId = $pdo->lastInsertId();
    }

    // 計算今天已經有幾筆訂單
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM `order` WHERE DATE(Order_Date) = CURDATE()");
    $stmt->execute();
    $countToday = $stmt->fetchColumn();

    // 今日的取餐編號 +1
    $pickupNumber = $countToday + 1;

    // ✅ 新增訂單並包含新的 Order_Remark 欄位
    // 這裡修改了 SQL 語句，加入了新的 `Order_Remark` 欄位及其對應的佔位符
    $stmt = $pdo->prepare("INSERT INTO `order` (Customer_ID, Order_Date, Order_exit, Pickup_Code, Order_Remark) VALUES (?, NOW(), 1, ?, ?)");
    $stmt->execute([
        $customerId,
        $pickupNumber,
        $orderRemarks // 這裡傳入整合後的備註字串
    ]);

    $orderId = $pdo->lastInsertId();

    // ✅ 插入訂單明細 + 扣除庫存 (此部分與您原程式碼相同)
    $menuQuery = $pdo->prepare("SELECT Menu_ID, category, Product_ID FROM menu WHERE Menu_name = ?");
    $itemInsert = $pdo->prepare("INSERT INTO order_item (Menu_ID, Order_ID, quantity, unit_price) VALUES (?, ?, ?, ?)");

    foreach ($itemNames as $i => $itemName) {
        $price = $itemPrices[$i];
        $qty = $itemQtys[$i];

        $menuQuery->execute([$itemName]);
        $menu = $menuQuery->fetch(PDO::FETCH_ASSOC);
        if (!$menu) {
            throw new Exception("找不到品項：「{$itemName}」");
        }

        $menuId = $menu['Menu_ID'];
        $category = $menu['category'];
        $productId = $menu['Product_ID'];

        // 插入訂單項目
        $itemInsert->execute([$menuId, $orderId, $qty, $price]);

        if ($category === '火鍋類') {
            // 火鍋類：查 HotPot_ID → hotpot 表查食材
            $stmt = $pdo->prepare("SELECT HotPot_ID FROM product WHERE Product_ID = ?");
            $stmt->execute([$productId]);
            $hotpot = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$hotpot) {
                throw new Exception("找不到火鍋產品的 HotPot_ID：「{$itemName}」");
            }

            $hotpotId = $hotpot['HotPot_ID'];

            // 查火鍋需要的食材與數量
            $stmt = $pdo->prepare("SELECT Ingredient_ID, quantity FROM hotpot WHERE HotPot_ID = ?");
            $stmt->execute([$hotpotId]);
            $ingredients = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($ingredients as $ing) {
                $ingredientId = $ing['Ingredient_ID'];
                $requiredQty = $ing['quantity'] * $qty;

                $stmtUpdate = $pdo->prepare("UPDATE ingredient SET current_stock = current_stock - ? WHERE Ingredient_ID = ?");
                $stmtUpdate->execute([$requiredQty, $ingredientId]);
            }
        } else {
            // 非火鍋類：從 product 表抓對應 Ingredient_ID
            $stmt = $pdo->prepare("SELECT Ingredient_ID FROM product WHERE Product_ID = ?");
            $stmt->execute([$productId]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$product || !$product['Ingredient_ID']) {
                throw new Exception("找不到產品對應的食材：「{$itemName}」");
            }

            $ingredientId = $product['Ingredient_ID'];

            $stmtUpdate = $pdo->prepare("UPDATE ingredient SET current_stock = current_stock - ? WHERE Ingredient_ID = ?");
            $stmtUpdate->execute([$qty, $ingredientId]); // 這邊 qty 就是需求數
        }
    }

    $pdo->commit();

    session_start();

    $_SESSION['pickupNumber'] = str_pad($pickupNumber, 3, '0', STR_PAD_LEFT);
    $_SESSION['orderid'] = $orderId;

    header("Location: index.php"); // ✅ 跳轉回首頁
    exit;
} catch (Exception $e) {
    $pdo->rollBack();
    echo "<p>❌ 發生錯誤：" . $e->getMessage() . "</p>";
    // 在開發階段可以顯示詳細錯誤，但在生產環境中應避免顯示具體錯誤訊息給用戶
    // error_log("訂單處理錯誤: " . $e->getMessage()); // 記錄錯誤到日誌
}
