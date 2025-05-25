<?php
// add_menu_and_ingredient.php
header('Content-Type: application/json');
include("db_connection.php");

// 接收 JSON
$input = json_decode(file_get_contents("php://input"), true);
$name     = trim($input['name'] ?? '');
$category = trim($input['category'] ?? '');
$price    = trim($input['price'] ?? '');

// 驗證輸入資料
if (!$name || !$category || !$price) {
    echo json_encode(['success'=>false, 'message'=>'欄位不可空白']);
    exit;
}

// 1) 插入一筆新的食材至 ingredient（unit 先留空、庫存設為 0）
$stmt1 = $conn->prepare("INSERT INTO ingredient (Ingredient_name, unit, current_stock) VALUES (?, ?, 0)");
$emptyUnit = "";
$stmt1->bind_param("ss", $name, $emptyUnit);
if (!$stmt1->execute()) {
    echo json_encode(['success'=>false, 'message'=>'新增食材失敗，' . $conn->error]);
    exit;
}
$newIngID = $conn->insert_id;
$stmt1->close();

// 2) 插入一筆新的產品到 `product` 資料表，並取得新插入的 `Product_ID`
$stmt2 = $conn->prepare("INSERT INTO product (cost_price, Ingredient_ID) VALUES (?, ?)");
$costPrice = 100.00;  // 假設價格為 100
$stmt2->bind_param("di", $costPrice, $newIngID);
if (!$stmt2->execute()) {
    echo json_encode(['success'=>false, 'message'=>'新增產品失敗，' . $conn->error]);
    exit;
}
$newProductID = $conn->insert_id;
$stmt2->close();

// 3) 插入對應的菜單資料
$stmt3 = $conn->prepare("INSERT INTO menu (Product_ID, Menu_name, sell_price, category, is_available) VALUES (?, ?, ?, ?, 1)");
$stmt3->bind_param("isds", $newProductID, $name, $price, $category);
if (!$stmt3->execute()) {
    echo json_encode(['success'=>false, 'message'=>'新增菜單失敗，' . $conn->error]);
    exit;
}

$stmt3->close();

// 回傳成功訊息
echo json_encode(['success'=>true]);
?>
