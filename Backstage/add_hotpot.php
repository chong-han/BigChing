<?php
include("db_connection.php");

// 開啟交易
$conn->begin_transaction();

try {
    // 1. 讀取前端傳來的資料
    $hotpotName  = $conn->real_escape_string($_POST['hotpotName']);
    $hotpotPrice = floatval($_POST['hotpotPrice']);
    $ingredients = json_decode($_POST['ingredients'], true);
    $quantities  = json_decode($_POST['quantities'], true);

    // 2. 計算下一個 HotPot_ID
    $res = $conn->query("SELECT COALESCE(MAX(HotPot_ID), 0) + 1 AS next_id FROM hotpot");
    $hotPotID = $res->fetch_assoc()['next_id'];

    // 3. 插入到 hotpot 表
    $stmtHotpot = $conn->prepare(
        "INSERT INTO hotpot (HotPot_ID, HotPot_name, Ingredient_ID, quantity)
         VALUES (?, ?, ?, ?)"
    );
    foreach ($ingredients as $i => $ingID) {
        $qty = intval($quantities[$i]);
        $stmtHotpot->bind_param("isii", $hotPotID, $hotpotName, $ingID, $qty);
        if (!$stmtHotpot->execute()) {
            throw new Exception("hotpot 插入失敗: " . $stmtHotpot->error);
        }
    }
    $stmtHotpot->close();

    // 4. 計算下一個 Product_ID
    $res = $conn->query("SELECT COALESCE(MAX(Product_ID), 0) + 1 AS next_id FROM product");
    $productID = $res->fetch_assoc()['next_id'];

    // 5. 插入到 product 表
    $costPrice = 100.00;
    $stmtProd = $conn->prepare(
        "INSERT INTO product (Product_ID, cost_price, Ingredient_ID, HotPot_ID)
         VALUES (?, ?, NULL, ?)"
    );
    $stmtProd->bind_param("idi", $productID, $costPrice, $hotPotID);
    if (!$stmtProd->execute()) {
        throw new Exception("product 插入失敗: " . $stmtProd->error);
    }
    $stmtProd->close();

    // 6. 計算下一個 Menu_ID
    $res = $conn->query("SELECT COALESCE(MAX(Menu_ID), 0) + 1 AS next_id FROM menu");
    $menuID = $res->fetch_assoc()['next_id'];

    // 7. 插入到 menu 表
    $stmtMenu = $conn->prepare(
        "INSERT INTO menu
         (Menu_ID, Product_ID, Menu_name, sell_price, category, is_available)
         VALUES (?, ?, ?, ?, '火鍋類', 1)"
    );
    $stmtMenu->bind_param("iisd", $menuID, $productID, $hotpotName, $hotpotPrice);
    if (!$stmtMenu->execute()) {
        throw new Exception("menu 插入失敗: " . $stmtMenu->error);
    }
    $stmtMenu->close();

    // 全部成功，提交交易
    $conn->commit();
    echo "火鍋新增成功！";

} catch (Exception $e) {
    // 有任何錯誤，回滾交易
    $conn->rollback();
    echo "操作失敗: " . $e->getMessage();
}

$conn->close();
?>
