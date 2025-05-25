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
  <link rel="stylesheet" href="assets/css/orders.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>
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
          <li><a href="commrid.php" id="porrid-link" data-username="<?php echo $_SESSION['username']; ?>"><span class="icon solid fa-truck">庫存管理</span></a></li>
          <li><a href="order_history.php" id="about-link"><span class="icon solid fa-list-alt" style="color: #000;">訂單管理</span></a></li>
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

  <!-- Main -->
  <div id="main">

    <h2>訂單紀錄管理</h2>
    <div class="search-box">
      <input type="text" id="search-input" placeholder="請輸入訂購人...">
      <button id="search-button">搜尋</button>
    </div>
    <div id="scroll-to-top" class="scroll-to-top">
      <i class="fas fa-chevron-up"></i>
    </div>
    <div id="add-product-past" class="scroll-to-top-2">
      <i class="far fa-calendar"></i>
    </div>
    <div id="add-product" class="scroll-to-top-3">
      <i class="fas fa-list-alt"></i>
    </div>
    <div id="advanced-search" class="scroll-to-top-4">
      <i class="fas fas fa-download"></i>
    </div>

    <div class="summary">
        <span>累計金額：<span id="total-amount">0</span>元</span>
    </div>

    <div id="mains">
      <?php
      // 1. 連接資料庫
      include("db_connection.php");

      // 2. 取出訂單與相關明細
      $sql = "
        SELECT 
          o.Order_ID,
          o.Order_Date,
          o.Pickup_Code,
          c.Customer_name,
          oi.quantity,
          oi.unit_price,
          m.Menu_name
        FROM `order` o
        JOIN customer c   ON o.Customer_ID = c.Customer_ID
        JOIN order_item oi ON o.Order_ID    = oi.Order_ID
        JOIN menu m       ON oi.Menu_ID     = m.Menu_ID
        ORDER BY o.Order_Date DESC, o.Order_ID, oi.Item_ID
      ";
      $res = $conn->query($sql);

      // 3. 將結果依 Order_ID 分組
      $orders = [];
      while ($row = $res->fetch_assoc()) {
        $id = $row['Order_ID'];
        if (!isset($orders[$id])) {
          $orders[$id] = [
            'date'    => $row['Order_Date'],
            'code'    => $row['Pickup_Code'],
            'customer'=> $row['Customer_name'],
            'items'   => []
          ];
        }
        $orders[$id]['items'][] = [
          'name'  => $row['Menu_name'],
          'qty'   => $row['quantity'],
          'price' => $row['unit_price']
        ];
      }

      // 4. 輸出成卡片
      foreach ($orders as $orderId => $o) {
        echo '<div class="card">';
          // 標題：訂單編號 + 顧客
          echo '<div class="card-header">訂單 #' . htmlspecialchars($orderId)
            . ' — ' . htmlspecialchars($o['customer']) . '</div>';
          // 內容：品項清單
          echo '<div class="card-body"><ul>';
          foreach ($o['items'] as $item) {
            echo '<li>'
              . htmlspecialchars($item['name']) . ' ×' 
              . intval($item['qty']) . ' ｜ $' 
              . number_format($item['price'], 2)
              . '</li>';
          }
          echo '</ul></div>';
          // 底部：日期與取餐碼
          echo '<div class="card-footer">'
            . date('Y-m-d H:i', strtotime($o['date'])) 
            . ' | 取餐碼：' . htmlspecialchars($o['code'])
            . '</div>';
        echo '</div>';
      }

      $conn->close();
      ?>
    </div>

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
  <script>



  </script>

</body>
</html>