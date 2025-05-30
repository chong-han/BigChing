<?php
// 检查用户提交的用户名和密码是否与管理员帐户匹配
// if ($_POST['username'] == 'admin@nutc.edu.tw' && $_POST['password'] == 'admin01admin') {
//     session_start();
//     $_SESSION['username'] = $_POST['username'];
//     header('Location: index.php'); // 登录成功后重定向到主页
// } else {
//     echo "登录失败，请检查用户名和密码。";
// }

// 檢查用戶提交的用戶名和密碼是否與管理員帳戶匹配
if ($_POST['username'] == 'admin@nutc.edu.tw' && $_POST['password'] == 'admin01admin') {
    session_start();
    $_SESSION['username'] = $_POST['username'];
    $response = array("success" => true);
    echo json_encode($response);
} else {
    $response = array("success" => false);
    echo json_encode($response);
}


?>

