<?php
include("db_connection.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => '只接受 POST 請求']);
    exit;
}

$menuId = $_POST['menu_id'] ?? null;
$name = trim($_POST['name'] ?? '');
$category = $_POST['category'] ?? '';
$price = $_POST['price'] ?? '';

if (!$menuId || !$name || !$category || !$price) {
    echo json_encode(['success' => false, 'message' => '缺少必要參數']);
    exit;
}

$conn->begin_transaction();

try {
    // 1. 找出 product 對應的 Ingredient_ID
    $stmt = $conn->prepare("SELECT p.Ingredient_ID FROM product p JOIN menu m ON p.Product_ID = m.Product_ID WHERE m.Menu_ID = ?");
    $stmt->bind_param("i", $menuId);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows === 0) throw new Exception("找不到對應產品");
    $row = $res->fetch_assoc();
    $ingredientId = $row['Ingredient_ID'];
    $stmt->close();

    // 2. 處理圖片上傳
    $newPicPath = null;
    if (isset($_FILES['pic']) && $_FILES['pic']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . "/bigching_pic/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        // 圖片檔名以 <品項名稱>.jpg 命名，避免亂碼與空格
        $safeName = preg_replace("/[^a-zA-Z0-9_-]/", "", $name);
        $targetFile = $uploadDir . $safeName . ".jpg";

        // 移動上傳檔案
        if (!move_uploaded_file($_FILES['pic']['tmp_name'], $targetFile)) {
            throw new Exception("圖片上傳失敗");
        }
        $newPicPath = "bigching_pic/" . $safeName . ".jpg";
    }

    // 3. 更新 menu 資料表
    if ($newPicPath !== null) {
        $sqlMenu = "UPDATE menu SET Menu_name=?, category=?, sell_price=?, pic=? WHERE Menu_ID=?";
    } else {
        $sqlMenu = "UPDATE menu SET Menu_name=?, category=?, sell_price=? WHERE Menu_ID=?";
    }
    $stmtMenu = $conn->prepare($sqlMenu);
    if ($newPicPath !== null) {
        $stmtMenu->bind_param("ssssi", $name, $category, $price, $newPicPath, $menuId);
    } else {
        $stmtMenu->bind_param("sssi", $name, $category, $price, $menuId);
    }
    if (!$stmtMenu->execute()) {
        throw new Exception("更新 menu 失敗");
    }
    $stmtMenu->close();

    // 4. 更新 ingredient 表的 Ingredient_name
    if ($ingredientId !== null) {
        $stmtIng = $conn->prepare("UPDATE ingredient SET Ingredient_name=? WHERE Ingredient_ID=?");
        $stmtIng->bind_param("si", $name, $ingredientId);
        if (!$stmtIng->execute()) {
            throw new Exception("更新 ingredient 失敗");
        }
        $stmtIng->close();
    }

    $conn->commit();
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
