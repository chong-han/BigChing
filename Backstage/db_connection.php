<?php
// db_connection.php

// 連接到資料庫
$servername = "localhost";
$username = "root"; //id21447255_nutcs11108310
$password = ""; //amamyrrem11201S@
$dbname = "bigching"; //id21447255_merrymama

$conn = new mysqli($servername, $username, $password, $dbname);

// 檢查連接是否成功
if ($conn->connect_error) {
    die("連接資料庫失敗: " . $conn->connect_error);
}
?>
