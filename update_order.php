<?php
include('db_connection.php');

header('Content-Type: application/json');

$orderId = intval($_POST['Order_ID'] ?? 0);
$action = $_POST['action'] ?? '';

if ($orderId > 0 && $action === 'complete') {
    $sql = "UPDATE `order` SET Order_exit = 1 WHERE Order_ID = $orderId";
    if ($conn->query($sql)) {
        echo json_encode(['success' => true, 'message' => '訂單已標記為完成']);
    } else {
        echo json_encode(['success' => false, 'message' => '更新失敗: ' . $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => '參數錯誤']);
}
$conn->close();
?>
