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
  <link rel="stylesheet" href="assets/css/members.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
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
          <li><a href="index.php" id="top-link"><span class="icon solid fa-user" style="color: #000;">會員管理</span></a></li>
          <li><a href="commodity.php" id="portfolio-link" data-username="<?php echo $_SESSION['username']; ?>"><span class="icon solid fa-shopping-bag">商品管理</span></a></li>
          <li><a href="commrid.php" id="porrid-link" data-username="<?php echo $_SESSION['username']; ?>"><span class="icon solid fa-truck">庫存管理</span></a></li>
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
    <h2 class="member-title">會員資料</h2>
    <div class="member-container">
      <?php
      include("db_connection.php");

      $sql = "SELECT Customer_name, Customer_mail, Customer_phone FROM customer";
      $result = $conn->query($sql);

      if ($result->num_rows > 0):
        while ($row = $result->fetch_assoc()): ?>
          <div class="member-card">
            <h3><?php echo htmlspecialchars($row['Customer_name']); ?></h3>
            <p><strong>信箱：</strong><?php echo htmlspecialchars($row['Customer_mail']); ?></p>
            <p><strong>電話：</strong><?php echo htmlspecialchars($row['Customer_phone']); ?></p>
          </div>
        <?php endwhile;
      else: ?>
        <p>目前無會員資料。</p>
      <?php endif;
      $conn->close();
      ?>
    </div>
  </div>


  <!-- Footer -->
  <div id="footer">
    <!-- Copyright -->
    <ul class="copyright">
      <li>&copy; 國立臺中科技大學</li>
      <li>中科大團隊 </li>
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
  <script>
    // 處理觸控和滑鼠事件
    document.querySelectorAll('.member-card p').forEach(function(paragraph) {
      // 點擊或觸碰展開
      paragraph.addEventListener('click', function() {
        this.classList.toggle('expanded');
      });

      // 針對觸控設備，使用 touchstart 事件來觸發
      paragraph.addEventListener('touchstart', function() {
        this.classList.toggle('expanded');
      });
    });
  </script>
</body>

</html>