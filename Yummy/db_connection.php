<?php
// 資料庫連線設定
define('DB_SERVER', 'localhost');    // 資料庫主機
define('DB_USERNAME', 'root'); // 資料庫使用者名稱
define('DB_PASSWORD', ''); // 資料庫密碼
define('DB_NAME', 'bigching');     // 資料庫名稱

// 建立 MySQLi 連線
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// 檢查連線是否成功
if ($conn->connect_error) {
  die("資料庫連線失敗: " . $conn->connect_error);
}

// 設定字符集為 UTF-8 以支援中文
$conn->set_charset("utf8");

// 你可以選擇關閉錯誤報告在生產環境中
// error_reporting(0);


// 資料庫連線設定
$host = 'localhost';
$dbname = 'bigching';
$user = 'root';
$pass = '';

try {
  // ✅ 使用 PDO 建立資料庫連線
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("資料庫連線失敗：" . $e->getMessage());
}
