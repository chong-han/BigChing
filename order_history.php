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
  <link rel="stylesheet" href="assets/css/ordersa.css" />
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

  <?php
  function format_price($price) {
      if (floor($price) == $price) {
          return number_format($price, 0);
      } else {
          return number_format($price, 2);
      }
  }
  ?>

  <div id="mains">
    <?php
      include("db_connection.php");

      $sql = "
        SELECT 
          o.Order_ID,
          o.Order_Date,
          o.Pickup_Code,
          o.Order_Remark,
          o.Order_exit,       -- 新增此欄
          c.Customer_name,
          oi.quantity,
          oi.unit_price,
          m.Menu_name
        FROM `order` o
        JOIN customer c    ON o.Customer_ID = c.Customer_ID
        JOIN order_item oi ON o.Order_ID    = oi.Order_ID
        JOIN menu m        ON oi.Menu_ID     = m.Menu_ID
        ORDER BY o.Order_Date DESC, o.Order_ID, oi.Item_ID
      ";
      $res = $conn->query($sql);

      $orders = [];
      $totalAmount = 0;
      while ($row = $res->fetch_assoc()) {
        $id = $row['Order_ID'];
          if (!isset($orders[$id])) {
            $orders[$id] = [
              'date'    => $row['Order_Date'],
              'code'    => $row['Pickup_Code'],
              'customer'=> $row['Customer_name'],
              'remark'  => $row['Order_Remark'],
              'exit'    => $row['Order_exit'],     // 新增
              'items'   => [],
              'subtotal'=> 0
            ];
          }
        $itemTotal = $row['quantity'] * $row['unit_price'];
        $orders[$id]['items'][] = [
          'name'  => $row['Menu_name'],
          'qty'   => $row['quantity'],
          'total' => $itemTotal
        ];
        $orders[$id]['subtotal'] += $itemTotal;
        $totalAmount += $itemTotal;
      }

      foreach ($orders as $orderId => $o) {
        echo '<div class="card">';
        echo '<div class="card-header">';
        echo '訂單 #' . htmlspecialchars($orderId) . ' — ' . htmlspecialchars($o['customer']);

        // 訂單狀態標籤
        if ($o['exit'] == 1) {
          echo '<span class="order-status completed">已完成</span>';
        } else {
          echo '<span class="order-status pending">未完成</span>';
        }

        echo '</div>';
        echo '<div class="card-body">';
        echo '<table class="items-table">';
        echo '<thead><tr><th>品名</th><th style="text-align:right;">數量</th><th style="text-align:right;">小計</th></tr></thead>';
        echo '<tbody>';
          foreach ($o['items'] as $item) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($item['name']) . '</td>';
            echo '<td style="text-align:right;">' . intval($item['qty']) . '</td>';
            echo '<td style="text-align:right;">$' . format_price($item['total']) . '</td>';
            echo '</tr>';
          }
          echo '</tbody></table>';

          if (!empty($o['remark'])) {
            $remarkArr = array_map('trim', explode(',', $o['remark']));
            echo '<table class="remark-table" style="width:100%; border-collapse: collapse; margin-top: 10px;">';
            echo '<thead><tr><th style="text-align:left; padding:4px 8px; border-bottom: 2px solid #2563eb;">項目</th><th style="text-align:left; padding:4px 8px; border-bottom: 2px solid #2563eb;">內容</th></tr></thead>';
            echo '<tbody>';
            foreach ($remarkArr as $line) {
              $parts = explode(':', $line, 2);
              if (count($parts) == 2) {
                $key = htmlspecialchars(trim($parts[0]));
                $val = htmlspecialchars(trim($parts[1]));
                echo "<tr>";
                echo "<td style='padding:4px 8px; border-bottom: 1px solid #ddd;'>$key</td>";
                echo "<td style='padding:4px 8px; border-bottom: 1px solid #ddd;'>$val</td>";
                echo "</tr>";
              }
            }
            echo '</tbody></table>';
          }

          echo '</div>'; // card-body
          echo '<div class="card-footer">'
            . date('Y-m-d H:i', strtotime($o['date'])) 
            . ' | 取餐碼：' . htmlspecialchars($o['code'])
            . ' | 訂單小計：$' . format_price($o['subtotal'])
            . '</div>';
            // 只有當訂單未完成（exit != 1）時，才顯示按鈕
            if ($o['exit'] != 1) {
                echo '<div class="card-actions">';
                echo '<button class="btn-complete" data-orderid="' . $orderId . '">完成</button>';

                echo '<button class="btn-cancel" data-orderid="' . $orderId . '">取消</button>';
                echo '</div>';
            }
        echo '</div>';
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>

    // 更新累計金額在頁面上
    document.getElementById('total-amount').textContent = '<?php echo number_format($totalAmount, 2); ?>';
    

    // 完成點下沒反應update_order.php
    $(document).ready(function(){
      $(document).on('click', '.btn-complete', function(){
        const orderId = $(this).data('orderid');
        if(confirm('確定標記訂單完成？')) {
          $.post('update_order.php', { Order_ID: orderId, action: 'complete' }, function(res){
            alert(res.message);
            if(res.success) location.reload();
          }, 'json')
          .fail(function(xhr, status, error) {
            alert('請求失敗: ' + error);
          });
        }
      });
    });


  </script>

</body>
</html>