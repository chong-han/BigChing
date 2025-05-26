<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>大慶滷味</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <link href="assets/img/favicon.ico" rel="icon">

  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Amatic+SC:wght@400;700&display=swap"
    rel="stylesheet">

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <link href="assets/css/main.css" rel="stylesheet">
  <link href="assets/css/search.css" rel="stylesheet">

</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center me-auto me-xl-0">
        <img src="assets/img/Logo2.png" alt="">
        <h1 class="sitename">大慶滷味</h1>
        <span>.</span>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php#hero">首頁<br></a></li>
          <li><a href="index.php#menu">菜單</a></li>
          <li><a href="index.php#contact">關於</a></li>
          <li><a href="#orderForm" id="orderQueryBtn">訂單查詢</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      <a class="btn btn-getstarted p-2 px-md-4 pb-1 disabled" id="cart-btn" title="購物車">
        <i class='bx-fw bx bxs-cart bx-sm'></i>
      </a>

      <script>
        // 查詢訂單
        document.getElementById("orderQueryBtn").addEventListener("click", function() {
          Swal.fire({
            title: "請輸入您的訂單編號",
            html: `
          <form  action="search_id.php" method="post" class="number-form">
            <div class="row gy-4">
              <div class="col-md-12">
                <input type="number" class="form-control" id="OrderSerch-btn" name="OrderSerchID" placeholder="輸入 訂單編號" required>
              </div>
              <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">查詢</button>
              </div>
            </div>
          </form>
        `,
            showConfirmButton: false, // 不顯示 SweetAlert 預設按鈕

          });
        });
      </script>
    </div>
  </header>

  <main class="main">

    <div class="page-title" data-aos="fade">
      <div class="container">
        <h1>訂單查詢</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.php">首頁</a></li>
            <li class="current">訂單查詢</li>
          </ol>
        </nav>
      </div>
    </div>
    <section id="starter-section" class="starter-section section">

      <div class="container section-title" data-aos="fade-up">
        <h2>訂單資訊</h2>
        <p><span class="description-title">訂單資訊</span></p>
      </div>
      <div class="container" data-aos="fade-up">
        <?php
        include("db_connection.php"); // 資料庫連線

        // 確保資料庫連線變數 $conn 已在 db_connection.php 中建立
        if (!$conn) {
          die("資料庫連線失敗: " . mysqli_connect_error());
        }

        // 檢查是否有透過 POST 方法傳入 OrderSerchID
        if (isset($_POST["OrderSerchID"]) && !empty($_POST["OrderSerchID"])) {
          // 使用 mysqli_real_escape_string 預防 SQL 注入
          $search_order_id = mysqli_real_escape_string($conn, $_POST["OrderSerchID"]);

          // 查詢訂單主表和訂單項目表的 SQL
          // **修改處：在 SELECT 中加入 o.ORDER_REMARK**
          // 使用 LEFT JOIN 以確保即使訂單沒有項目，基本訂單資訊也能顯示
          $sql_query = "
                SELECT
                    o.Order_ID,
                    c.Customer_name,
                    o.Order_Date,
                    o.Order_exit,
                    o.Pickup_Code,
                    o.ORDER_REMARK,
                    mi.Menu_name,
                    oi.quantity,
                    oi.unit_price
                FROM
                    `order` AS o
                LEFT JOIN
                    `customer` AS c ON o.Customer_ID = c.Customer_ID
                LEFT JOIN
                    `order_item` AS oi ON o.Order_ID = oi.Order_ID
                LEFT JOIN
                    `menu` AS mi ON oi.Menu_ID = mi.Menu_ID
                WHERE
                    o.Order_ID = '$search_order_id'
                ORDER BY
                    o.Order_ID, mi.Menu_name;
            ";

          $result = mysqli_query($conn, $sql_query); // 執行查詢

          if ($result) {
            if (mysqli_num_rows($result) > 0) {
              // 儲存訂單主資訊，因為它會在每個項目中重複
              $order_info = null;
              $order_items = [];

              while ($row = mysqli_fetch_assoc($result)) { // 使用 mysqli_fetch_assoc 讓結果陣列的鍵名是欄位名稱
                if ($order_info === null) {
                  $order_info = [
                    'Order_ID' => $row['Order_ID'],
                    'Customer_name' => $row['Customer_name'],
                    'Order_Date' => $row['Order_Date'],
                    'Order_exit' => $row['Order_exit'],
                    'Pickup_Code' => $row['Pickup_Code'],
                    'ORDER_REMARK' => $row['ORDER_REMARK'] // 新增：儲存訂單備註
                  ];
                }
                // 只有當 Menu_name 不為 NULL 時，才表示有訂單項目
                if ($row['Menu_name'] !== null) {
                  $order_items[] = [
                    'Menu_name' => $row['Menu_name'],
                    'quantity' => $row['quantity'],
                    'unit_price' => $row['unit_price']
                  ];
                }
              }

              echo "
              <div class='card mb-4 col-12 shadow-sm'>
                <div class='card-header'>
                  <p class='h4 mb-0'>訂單編號: 0" . htmlspecialchars($order_info['Order_ID']) . " 的詳細資訊</p>
                </div>
                <div class='card-body'>
                  <p class='mb-2'><strong>👤 顧客姓名:</strong> " . htmlspecialchars($order_info['Customer_name']) . "</p>
                  <p class='mb-2'><strong>🗓️ 訂購日期:</strong> " . htmlspecialchars($order_info['Order_Date']) . "</p>
                  <p class='mb-2'><strong>✅ 訂單是否完成:</strong> " . ($order_info['Order_exit'] == 1 ? '<span class="text-success">是</span>' : '<span class="text-danger">否</span>') . "</p>
                  <p class='mb-2'><strong>🔢 取餐編號:</strong> " . htmlspecialchars($order_info['Pickup_Code']) . "</p>";

              // **新增：顯示訂單備註，如果存在且不為空**
              if (!empty($order_info['ORDER_REMARK'])) {
                echo "<p class='mb-0'><strong>📝 訂單備註:</strong> " . nl2br(htmlspecialchars($order_info['ORDER_REMARK'])) . "</p>";
              } else {
                echo "<p class='mb-0'><strong>📝 訂單備註:</strong> 無</p>";
              }

              echo "
                </div>
              </div>
              ";
            } else {
              echo "<p>找不到訂單 ID 為 " . htmlspecialchars($search_order_id) . " 的記錄。</p>";
            }
          } else {
            echo "<p>執行查詢時發生錯誤: " . mysqli_error($conn) . "</p>";
          }
        } else {
          echo "<p>請透過 POST 方法傳入 'OrderSerchID' 參數。</p>";
        }
        ?>

      </div>

      <div class="container section-title" data-aos="fade-up">
        <h2>訂單項目</h2>
        <p><span class="description-title">訂單項目</span></p>
      </div>
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <?php

        if (!empty($order_items)) {
          echo "<table  class='table table-hover shadow-sm'>";
          echo "<thead class='text-center table-light'>
            <tr >
              <th scope='col'>品項</th>
              <th scope='col'>單價</th>
              <th scope='col'>數量</th>
              <th scope='col'>小計</th>
            </tr>
          </thead>";
          echo "<tbody>";

          $total_order_price = 0;
          foreach ($order_items as $item) {
            $item_total = $item['quantity'] * $item['unit_price'];
            $total_order_price += $item_total;

            echo "<tr class='text-center'>";
            echo "<td>" . htmlspecialchars($item['Menu_name']) . "</td>";
            echo "<td>$" . htmlspecialchars(number_format($item['unit_price'], 2)) . "</td>";
            echo "<td>" . htmlspecialchars($item['quantity']) . "</td>";
            echo "<td>$" . htmlspecialchars(number_format($item_total, 2)) . "</td>";
            echo "</tr>";
          }

          echo "</tbody>";
          echo "</table>";
          echo "<div class='text-end mt-2 me-4'>
                <strong>訂單總金額 : </strong>  <strong>$" . htmlspecialchars(number_format($total_order_price, 2)) . "</strong>
          </div>";
        } else {
          echo "<p>此訂單沒有任何項目。</p>";
        }


        // 關閉資料庫連線
        mysqli_close($conn);
        ?>

      </div>
    </section>
  </main>

  <footer id="footer" class="footer dark-background">

    <div class="container">
      <div class="row gy-3">
        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-geo-alt icon"></i>
          <div class="address">
            <h4>Address</h4>
            <p>台中市南區</p>
            <p>大慶街二段2-5號</p>
            <p></p>
          </div>

        </div>

        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-telephone icon"></i>
          <div>
            <h4>Contact</h4>
            <p>
              <strong>Phone:</strong> <span>0907 328 416</span><br>
              <strong>Email:</strong> <span>info@example.com</span><br>
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-clock icon"></i>
          <div>
            <h4>Opening Hours</h4>
            <p>
              <strong>星期一 - 星期五</strong>: <span>16:30 - 23:30</span><br>
              <strong>星期六、星期日</strong>: <span>休息</span>
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <h4>Follow Us</h4>
          <div class="social-links d-flex">
            <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

      </div>
    </div>
  </footer>

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    $('form').on('submit', function(e) {
      e.preventDefault(); // 阻止預設提交行為（防止立即刷新）

      const $form = $(this);
      const $btn = $form.find('.check_btn').addClass('sending').blur();

      // 模擬等待，然後真的送出（你可以改成 AJAX）
      setTimeout(function() {
        $btn.removeClass('sending');
        $form.off('submit').submit(); // 移除防止送出的攔截器並真正送出
      }, 2000); // 等 2 秒
    });
  </script>

  <script src="assets/js/main.js"></script>

</body>

</html>