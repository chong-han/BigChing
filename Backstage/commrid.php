<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.html'); // 如果未登录，重定向到登录页面
    exit();
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>大慶滷味</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/commrid.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>

    </style>
</head>
<body class="is-preload">
    <!-- Header -->
    <div id="header">
        <div class="top">
            <!-- Logo -->
            <div id="logo">
                <div class="image">
                    <span class="image avatar48"><img src="images/LOGOS.jpg" alt="" /></span>
                </div>
                <div class="content">
                    <h1 id="title">大慶滷味</h1>
                    <p>後臺管理系統</p>
                </div>
            </div>
            <!-- Nav -->
            <nav id="nav">
                <ul>
                    <li><a href="index.php" id="top-link" data-username="<?php echo $_SESSION['username']; ?>"><span class="icon solid fa-user">會員管理</span></a></li>
                    <li><a href="commodity.php" id="portfolio-link" data-username="<?php echo $_SESSION['username']; ?>"><span class="icon solid fa-shopping-bag">商品管理</span></a></li>
                    <li><a href="commrid.php" id="porrid-link"><span class="icon solid fa-truck" style="color: #000;">庫存管理</span></a></li>
                    <li><a href="order_history.php" id="about-link" data-username="<?php echo $_SESSION['username']; ?>"><span class="icon solid fa-list-alt">訂單管理</span></a></li>
                    <li><a href="dataanalysis.php" id="contact-link" data-username="<?php echo $_SESSION['username']; ?>"><span class="icon solid fa-chart-bar">數據分析</span></a></li>
                </ul>
            </nav>
        </div>
        <div class="bottom">

            <!-- Social Icons -->
            <ul class="icons">
            <li><span class="icon solid fa-sign-out-alt"><a href="logout.php">登出</a></span></li>
            </ul>

        </div>
    </div>

    <div id="main">
        <?php

        include("db_connection.php");

        if ($conn->connect_error) {
            die("連線失敗: " . $conn->connect_error);
        }

        // 查詢 ingredient 資料表
        $sql = "SELECT * FROM ingredient";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="card">';
                echo '<h3>' . htmlspecialchars($row["Ingredient_name"]) . '</h3>';
                echo '<p>單位：' . htmlspecialchars($row["unit"]) . '</p>';
                echo '<p>目前庫存：' . htmlspecialchars($row["current_stock"]) . '</p>';
                echo '</div>';
            }
        } else {
            echo "查無食材資料";
        }

        $conn->close();
        ?>
    </div>



    <!-- Footer -->
    <div id="footer">
        <!-- Copyright -->
        <ul class="copyright">
            <li>&copy; 國立臺中科技大學</li><li>中科大團隊 </li>
        </ul>
    </div>
    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.scrolly.min.js"></script>
    <script src="assets/js/jquery.scrollex.min.js"></script>
    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>

</body>
</html>
