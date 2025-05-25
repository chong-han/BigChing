<?php
include("db_connection.php");
$data = json_decode(file_get_contents('php://input'), true);
$menuID = intval($data['menuID'] ?? 0);

$conn->begin_transaction();
try {
    // 1) 先取得 productID 和 hotpotID
    $stmt = $conn->prepare("
        SELECT p.Product_ID, p.HotPot_ID
        FROM menu m
        JOIN product p ON m.Product_ID = p.Product_ID
        WHERE m.Menu_ID = ?
    ");
    $stmt->bind_param("i", $menuID);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows === 0) {
        throw new Exception("找不到對應的商品");
    }
    $row = $res->fetch_assoc();
    $productID = (int)$row['Product_ID'];
    $hotpotID  = (int)$row['HotPot_ID'];
    $stmt->close();

    // 2) 刪除 menu
    $stmt = $conn->prepare("DELETE FROM menu WHERE Menu_ID = ?");
    $stmt->bind_param("i", $menuID);
    $stmt->execute();
    $stmt->close();

    // 3) 刪除 product
    $stmt = $conn->prepare("DELETE FROM product WHERE Product_ID = ?");
    $stmt->bind_param("i", $productID);
    $stmt->execute();
    $stmt->close();

    // 4) 刪除 hotpot 裡的用料
    $stmt = $conn->prepare("DELETE FROM hotpot WHERE HotPot_ID = ?");
    $stmt->bind_param("i", $hotpotID);
    $stmt->execute();
    $stmt->close();

    $conn->commit();
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
$conn->close();
