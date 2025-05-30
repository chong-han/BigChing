<?php
include("db_connection.php");

$response = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 確保資料存在
    if (isset($_POST["id"]) && isset($_POST["amount"])) {
        $id = $_POST["id"];
        $amount = $_POST["amount"];

        // 驗證報銷數量是否為正數
        if (is_numeric($amount) && $amount > 0) {
            // 更新庫存，將報銷數量從現有庫存中減去
            $sql = "UPDATE ingredient SET current_stock = current_stock - ? WHERE Ingredient_ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $amount, $id);

            if ($stmt->execute()) {
                $response['status'] = 'success';
                $response['message'] = '庫存已成功更新！';
            } else {
                $response['status'] = 'error';
                $response['message'] = '庫存更新失敗，請稍後再試。';
            }

            $stmt->close();
        } else {
            $response['status'] = 'error';
            $response['message'] = '無效的數量！';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = '缺少必要參數！';
    }
}

$conn->close();

// 返回 JSON 格式的回應
echo json_encode($response);
?>
