<?php
// 資料庫設定
include("db_connection.php");

if (!isset($_POST['name'], $_POST['phone'], $_POST['item_name'])) {
    die("資料不完整。");
}

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = !empty($_POST['email']) ? $_POST['email'] : null;
$payment = $_POST['payment'] ?? '';
$cartTotal = $_POST['cart_total'] ?? 0;

$itemNames = $_POST['item_name'];
$itemPrices = $_POST['item_price'];
$itemQtys = $_POST['item_qty'];

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

    // ✅ 新增訂單
    $stmt = $pdo->prepare("INSERT INTO `order` (Customer_ID, Order_Date, Order_exit) VALUES (?, NOW(), 1)");
    $stmt->execute([$customerId]);
    $orderId = $pdo->lastInsertId();

    // ✅ 插入訂單明細
    $menuQuery = $pdo->prepare("SELECT Menu_ID FROM menu WHERE Menu_name = ?");
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
        $itemInsert->execute([$menuId, $orderId, $qty, $price]);
    }

    $pdo->commit();

    header("Location: index.php"); // ✅ 跳轉回首頁
    exit;

    // echo "<h3>✅ 訂單已送出！</h3><p>訂單編號：$orderId</p>";
} catch (Exception $e) {
    $pdo->rollBack();
    echo "<p>❌ 發生錯誤：" . $e->getMessage() . "</p>";
}
