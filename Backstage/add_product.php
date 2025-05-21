<?php
// 設置內容類型為 JSON
header('Content-Type: application/json');

// 連接資料庫
include('db_connection.php');

// 讀取 JSON 請求資料
$data = json_decode(file_get_contents('php://input'), true);

// 確保資料完整
if (!isset($data['product_name']) || !isset($data['category']) || !isset($data['price'])) {
    echo json_encode(['success' => false, 'message' => '缺少必要的資料']);
    exit;
}

// 獲取表單資料
$product_name = $data['product_name'];
$category = $data['category'];
$price = $data['price'];

// 開始事務處理
$conn->begin_transaction();

try {
    // 1. 新增 ingredient 資料
    $stmt = $conn->prepare("INSERT INTO ingredient (Ingredient_name, unit, current_stock) VALUES (?, ?, ?)");
    $unit = '份';  // 假設是「份」
    $current_stock = 100;  // 假設庫存為100
    $stmt->bind_param('ssi', $product_name, $unit, $current_stock);
    if (!$stmt->execute()) {
        throw new Exception("新增 ingredient 失敗");
    }

    // 2. 取得剛新增的 Ingredient_ID
    $ingredient_id = $conn->insert_id;

    // 3. 新增 menu 資料
    $stmt = $conn->prepare("INSERT INTO menu (Product_ID, Menu_name, sell_price, category, is_available) VALUES (?, ?, ?, ?, ?)");
    $is_available = 1; // 預設為上架
    $stmt->bind_param('isdis', $ingredient_id, $product_name, $price, $category, $is_available);
    if (!$stmt->execute()) {
        throw new Exception("新增 menu 失敗");
    }

    // 提交事務
    $conn->commit();

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    // 發生錯誤時回滾事務
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => '資料新增失敗: ' . $e->getMessage()]);
}

// 關閉資料庫連線
$conn->close();
?>
