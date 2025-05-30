<?php
// add_menu_and_ingredient.php
header('Content-Type: application/json');
include("db_connection.php");

// 確認為 POST 且有檔案
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 接收文字欄位（用 $_POST）
    $name = trim($_POST['name'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $price = trim($_POST['price'] ?? '');

    if (!$name || !$category || !$price) {
        echo json_encode(['success' => false, 'message' => '欄位不可空白']);
        exit;
    }

    // 接收檔案
    if (!isset($_FILES['pic']) || $_FILES['pic']['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(['success' => false, 'message' => '圖片上傳失敗']);
        exit;
    }

    $pic = $_FILES['pic'];

    // 圖片副檔名可改成固定 jpg，或從原始檔案判斷
    $uploadDir = "bigching_pic/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    $targetFile = $uploadDir . $name . ".jpg";  // 依要求存成 .jpg

    // 可以檢查檔案是否為圖片
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
    if (!in_array($pic['type'], $allowedTypes)) {
        echo json_encode(['success' => false, 'message' => '只允許 jpg, jpeg, png, gif 格式']);
        exit;
    }

    // 移動上傳檔案到目標路徑（會覆蓋同名檔案）
    if (!move_uploaded_file($pic['tmp_name'], $targetFile)) {
        echo json_encode(['success' => false, 'message' => '圖片儲存失敗']);
        exit;
    }

    // 新增食材到 ingredient 表
    $emptyUnit = "";
    $stmt1 = $conn->prepare("INSERT INTO ingredient (Ingredient_name, unit, current_stock) VALUES (?, ?, 0)");
    $stmt1->bind_param("ss", $name, $emptyUnit);
    if (!$stmt1->execute()) {
        echo json_encode(['success' => false, 'message' => '新增食材失敗，' . $conn->error]);
        exit;
    }
    $newIngID = $conn->insert_id;
    $stmt1->close();

    // 新增產品到 product 表（價格型態請依實際調整）
    $costPrice = floatval($price);
    $stmt2 = $conn->prepare("INSERT INTO product (cost_price, Ingredient_ID) VALUES (?, ?)");
    $stmt2->bind_param("di", $costPrice, $newIngID);
    if (!$stmt2->execute()) {
        echo json_encode(['success' => false, 'message' => '新增產品失敗，' . $conn->error]);
        exit;
    }
    $newProductID = $conn->insert_id;
    $stmt2->close();

    // 新增菜單到 menu 表，pic 欄位存圖片相對路徑
    $picPath = $uploadDir . $name . ".jpg";
    $stmt3 = $conn->prepare("INSERT INTO menu (Product_ID, Menu_name, sell_price, category, is_available, pic) VALUES (?, ?, ?, ?, 1, ?)");
    $stmt3->bind_param("isdss", $newProductID, $name, $costPrice, $category, $picPath);
    if (!$stmt3->execute()) {
        echo json_encode(['success' => false, 'message' => '新增菜單失敗，' . $conn->error]);
        exit;
    }
    $stmt3->close();

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => '請求方法錯誤']);
}
?>
