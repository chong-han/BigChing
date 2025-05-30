<?php
include("db_connection.php");

$conn->begin_transaction();

try {
    // 文字資料改用 $_POST
    $hotpotName  = $conn->real_escape_string($_POST['hotpotName']);
    $hotpotPrice = floatval($_POST['hotpotPrice']);
    $ingredients = json_decode($_POST['ingredients'], true);
    $quantities  = json_decode($_POST['quantities'], true);

    // 圖片檔案從 $_FILES 拿
    if (!isset($_FILES['pic']) || $_FILES['pic']['error'] !== UPLOAD_ERR_OK) {
        throw new Exception("圖片上傳失敗");
    }
    $pic = $_FILES['pic'];

    $uploadDir = "bigching_pic/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    $targetFile = $uploadDir . $hotpotName . ".jpg";

    // 檢查檔案類型（可依需求擴充）
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
    if (!in_array($pic['type'], $allowedTypes)) {
        throw new Exception("只允許 jpg, jpeg, png, gif 格式的圖片");
    }

    // 將檔案移動到指定資料夾並改名
    if (!move_uploaded_file($pic['tmp_name'], $targetFile)) {
        throw new Exception("圖片儲存失敗");
    }

    // 1. 計算下一個 HotPot_ID
    $res = $conn->query("SELECT COALESCE(MAX(HotPot_ID), 0) + 1 AS next_id FROM hotpot");
    $hotPotID = $res->fetch_assoc()['next_id'];

    // 2. 插入到 hotpot 表
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

    // 3. 計算下一個 Product_ID
    $res = $conn->query("SELECT COALESCE(MAX(Product_ID), 0) + 1 AS next_id FROM product");
    $productID = $res->fetch_assoc()['next_id'];

    // 4. 插入到 product 表
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

    // 5. 計算下一個 Menu_ID
    $res = $conn->query("SELECT COALESCE(MAX(Menu_ID), 0) + 1 AS next_id FROM menu");
    $menuID = $res->fetch_assoc()['next_id'];

    // 6. 插入到 menu 表，並將圖片路徑存到 pic 欄位
    $picPath = $uploadDir . $hotpotName . ".jpg";
    $stmtMenu = $conn->prepare(
        "INSERT INTO menu
         (Menu_ID, Product_ID, Menu_name, sell_price, category, is_available, pic)
         VALUES (?, ?, ?, ?, '火鍋類', 1, ?)"
    );
    $stmtMenu->bind_param("iisds", $menuID, $productID, $hotpotName, $hotpotPrice, $picPath);

    if (!$stmtMenu->execute()) {
        throw new Exception("menu 插入失敗: " . $stmtMenu->error);
    }
    $stmtMenu->close();

    $conn->commit();
    echo "火鍋新增成功！";

} catch (Exception $e) {
    $conn->rollback();
    echo "操作失敗: " . $e->getMessage();
}

$conn->close();
?>
