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
  <link rel="stylesheet" href="assets/css/dataanalysisa.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
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
          <li><a href="commrid.php" id="porrid-link" data-username="<?php echo $_SESSION['username']; ?>"><span class="icon solid fa-truck">庫存管理</span></a></li>
          <li><a href="order_history.php" id="about-link" data-username="<?php echo $_SESSION['username']; ?>"><span class="icon solid fa-list-alt">訂單管理</span></a></li>
          <li><a href="dataanalysis.php" id="contact-link"><span class="icon solid fa-chart-bar" style="color: #000;">數據分析</span></a></li>
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

<?php
// --- PHP部分與之前相同，只取回分析數據 ---
$host = '127.0.0.1';
$dbname = 'bigching';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (Exception $e) {
    exit('資料庫連接失敗: ' . $e->getMessage());
}

$totalCustomers = $pdo->query("SELECT COUNT(*) FROM customer")->fetchColumn();

$menuStats = $pdo->query("SELECT category, COUNT(*) AS count FROM menu GROUP BY category")->fetchAll();
$totalMenuItems = array_sum(array_column($menuStats, 'count'));

$totalHotpots = $pdo->query("SELECT COUNT(DISTINCT HotPot_ID) FROM hotpot")->fetchColumn();
$hotpotIngredientCounts = $pdo->query("SELECT HotPot_ID, COUNT(Ingredient_ID) AS ingredient_count FROM hotpot GROUP BY HotPot_ID")->fetchAll(PDO::FETCH_KEY_PAIR);

$totalOrders = $pdo->query("SELECT COUNT(*) FROM `order`")->fetchColumn();
$completedOrders = $pdo->query("SELECT COUNT(*) FROM `order` WHERE Order_exit = 1")->fetchColumn();
$completedRatio = $totalOrders ? round($completedOrders / $totalOrders * 100, 2) : 0;

$topMenuItems = $pdo->query("
    SELECT m.Menu_name, SUM(oi.quantity) AS total_quantity
    FROM order_item oi
    JOIN menu m ON oi.Menu_ID = m.Menu_ID
    GROUP BY oi.Menu_ID
    ORDER BY total_quantity DESC
    LIMIT 5
")->fetchAll();

$lowStockIngredients = $pdo->query("SELECT Ingredient_name, current_stock, unit FROM ingredient WHERE current_stock < 20 ORDER BY current_stock ASC")->fetchAll();
?>

<div id="main">

  <section>
    <h3>顧客統計</h3>
    <p>總顧客數量：<strong><?= $totalCustomers ?></strong></p>
  </section>

  <section>
    <h3>菜單品項統計</h3>
    <p>總菜單品項數：<strong><?= $totalMenuItems ?></strong></p>
    <ul>
      <?php foreach ($menuStats as $row): ?>
        <li><?= htmlspecialchars($row['category']) ?>：<?= $row['count'] ?> 項</li>
      <?php endforeach; ?>
    </ul>
    <div class="chart-container">
      <canvas id="menuCategoryChart"></canvas>
    </div>
  </section>

  <section>
    <h3>火鍋種類與食材數量</h3>
    <p>火鍋種類總數：<strong><?= $totalHotpots ?></strong></p>
    <ul>
      <?php foreach ($hotpotIngredientCounts as $hotpotId => $count): ?>
        <li>火鍋 ID <?= $hotpotId ?> 含食材數量：<?= $count ?></li>
      <?php endforeach; ?>
    </ul>
    <div class="chart-container">
      <canvas id="hotpotIngredientsChart"></canvas>
    </div>
  </section>

  <section>
    <h3>訂單狀況</h3>
    <p>訂單總數：<strong><?= $totalOrders ?></strong></p>
    <p>完成訂單數：<strong><?= $completedOrders ?></strong> （完成比例：<?= $completedRatio ?>%）</p>
    <div class="chart-container">
      <canvas id="orderCompletionChart"></canvas>
    </div>
  </section>

  <section>
    <h3>熱賣菜品前 5 名</h3>
    <ol>
      <?php foreach ($topMenuItems as $item): ?>
        <li><?= htmlspecialchars($item['Menu_name']) ?> — 銷售數量：<?= $item['total_quantity'] ?></li>
      <?php endforeach; ?>
    </ol>
    <div class="chart-container">
      <canvas id="topMenuChart"></canvas>
    </div>
  </section>

  <section>
    <h3>庫存不足食材（庫存量低於 20）</h3>
    <?php if (count($lowStockIngredients) > 0): ?>
      <ul>
        <?php foreach ($lowStockIngredients as $ing): ?>
          <li><?= htmlspecialchars($ing['Ingredient_name']) ?>：剩餘 <?= $ing['current_stock'] ?> <?= htmlspecialchars($ing['unit']) ?></li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      <p>目前所有食材庫存充足。</p>
    <?php endif; ?>
  </section>
</div>




    <!-- Footer -->
  <div id="footer">
      <!-- Copyright -->
    <ul class="copyright">
        <li>&copy; 國立臺中科技大學</li><li>中科大團隊 </li>
    </ul>
    </div>
  </div>
  <!-- Scripts -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/jquery.scrolly.min.js"></script>
  <script src="assets/js/jquery.scrollex.min.js"></script>
  <script src="assets/js/browser.min.js"></script>
  <script src="assets/js/breakpoints.min.js"></script>
  <script src="assets/js/util.js"></script>
  <script src="assets/js/main.js"></script>
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// 解析 PHP 陣列資料成 JS 陣列
const menuCategoryLabels = <?= json_encode(array_column($menuStats, 'category')) ?>;
const menuCategoryData = <?= json_encode(array_column($menuStats, 'count')) ?>;

const hotpotLabels = <?= json_encode(array_keys($hotpotIngredientCounts)) ?>;
const hotpotData = <?= json_encode(array_values($hotpotIngredientCounts)) ?>;

const completedOrders = <?= $completedOrders ?>;
const incompleteOrders = <?= $totalOrders - $completedOrders ?>;

const topMenuLabels = <?= json_encode(array_column($topMenuItems, 'Menu_name')) ?>;
const topMenuData = <?= json_encode(array_column($topMenuItems, 'total_quantity')) ?>;

// Chart.js 設定與繪製

// 菜單分類圓餅圖
new Chart(document.getElementById('menuCategoryChart'), {
  type: 'pie',
  data: {
    labels: menuCategoryLabels,
    datasets: [{
      label: '菜單分類分佈',
      data: menuCategoryData,
      backgroundColor: [
        '#4e79a7', '#f28e2b', '#e15759', '#76b7b2', '#59a14f', '#edc948',
        '#b07aa1', '#ff9da7', '#9c755f', '#bab0ac'
      ]
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: { position: 'bottom' },
      title: { display: true, text: '菜單分類分佈圖' }
    }
  }
});

// 火鍋種類食材數量長條圖
new Chart(document.getElementById('hotpotIngredientsChart'), {
  type: 'bar',
  data: {
    labels: hotpotLabels.map(id => '火鍋ID ' + id),
    datasets: [{
      label: '食材數量',
      data: hotpotData,
      backgroundColor: '#4e79a7'
    }]
  },
  options: {
    responsive: true,
    scales: { y: { beginAtZero: true, precision: 0 } },
    plugins: {
      legend: { display: false },
      title: { display: true, text: '火鍋種類食材數量' }
    }
  }
});

// 訂單完成比例環狀圖
new Chart(document.getElementById('orderCompletionChart'), {
  type: 'doughnut',
  data: {
    labels: ['完成訂單', '未完成訂單'],
    datasets: [{
      label: '訂單完成比例',
      data: [completedOrders, incompleteOrders],
      backgroundColor: ['#59a14f', '#e15759']
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: { position: 'bottom' },
      title: { display: true, text: '訂單完成比例' }
    }
  }
});

// 熱賣菜品前5名長條圖
new Chart(document.getElementById('topMenuChart'), {
  type: 'bar',
  data: {
    labels: topMenuLabels,
    datasets: [{
      label: '銷售數量',
      data: topMenuData,
      backgroundColor: '#f28e2b'
    }]
  },
  options: {
    responsive: true,
    scales: { y: { beginAtZero: true, precision: 0 } },
    plugins: {
      legend: { display: false },
      title: { display: true, text: '熱賣菜品前 5 名' }
    }
  }
});
</script>
</body>
</html>