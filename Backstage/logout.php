<?php
session_start();
session_destroy(); // 销毁会话数据
header('Location: login.html'); // 注销后重定向到登录页面
?>
