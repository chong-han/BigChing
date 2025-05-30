<?php
// toggle_availability.php
header('Content-Type: application/json');
include("db_connection.php");

$data = json_decode(file_get_contents("php://input"), true);
$menu_name = $data['menu_name'] ?? '';

if ($menu_name === '') {
    echo json_encode(["success" => false, "message" => "未提供品項名稱"]);
    exit;
}

// 查詢目前的 is_available 值
$sql = "SELECT is_available FROM menu WHERE Menu_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $menu_name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(["success" => false, "message" => "找不到該商品"]);
    exit;
}

$row = $result->fetch_assoc();
$current_status = $row['is_available'];
$new_status = $current_status == 1 ? 0 : 1;

// 更新 is_available 狀態
$update = $conn->prepare("UPDATE menu SET is_available = ? WHERE Menu_name = ?");
$update->bind_param("is", $new_status, $menu_name);
$success = $update->execute();

echo json_encode(["success" => $success]);
?>
