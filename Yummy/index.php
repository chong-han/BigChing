<?php
session_start();
$pickupMessage = '';

if (isset($_SESSION['pickupNumber'])) {
  $pickupMessage = "您的今日取餐編號是：" . htmlspecialchars($_SESSION['pickupNumber']);
  unset($_SESSION['pickupNumber']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>大慶滷味</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.ico" rel="icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Amatic+SC:wght@400;700&display=swap"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Yummy
  * Template URL: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

</head>

<body class="index-page">

  <?php if (!empty($pickupMessage)): ?>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
          icon: 'info',
          title: '取餐通知',
          text: '<?= $pickupMessage ?>',
          confirmButtonText: '我知道了',
          confirmButtonColor: '#3085d6',
          background: '#fff',
          backdrop: true
        });
      });
    </script>
  <?php endif; ?>

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets/img/Logo2.png" alt="">
        <h1 class="sitename">大慶滷味</h1>
        <span>.</span>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">首頁<br></a></li>
          <li><a href="#menu">菜單</a></li>
          <li><a href="#contact">關於</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      <!-- 購物車按鈕 -->
      <a class="btn btn-getstarted add-cart p-2 px-md-4 pb-1" id="cart-btn" title="購物車">
        <i class='bx-fw bx bxs-cart bx-sm'></i>
        <span id="cart-count" class="cart-count">0</span>
      </a>
      <!-- 購物車互動視窗 -->
      <div id="cart-modal" class="cart-modal">
        <div class="cart-modal-content">
          <form name="form1" action="checkout.php" method="post" id="checkoutForm">
            <span id="close-cart" class="close">&times;</span>
            <h4 class="mb-3">購物車清單</h4>
            <div class="table-responsive">
              <table class="table table-bordered table-sm align-middle text-center" id="cart-table">
                <thead class="table-light">
                  <tr>
                    <th>品項</th>
                    <th>單價</th>
                    <th>數量</th>
                    <th>小計</th>
                    <th> </th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <div class="text-end mt-3">
              <strong>總金額：</strong><span id="cart-total" class="text-danger fw-bold">$0.00</span>
            </div>
            <input id="checkout-btn" class="btn btn-success mt-3 col-12 " type="submit" value="結帳"></input>
          </form>
        </div>
      </div>
      <!-- 提示窗 -->
      <div id="successToast"
        class="toast align-items-center border-0 position-fixed start-50 translate-middle-x m-3 shadow"
        style="top: 10vh;" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body">
            ✅ 已加入購物車！
          </div>
        </div>
      </div>


    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">

      <div class="container">
        <div class="row gy-4 justify-content-center justify-content-lg-between">
          <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h1 data-aos="fade-up">飄香四溢的滷味，<br>讓你一口就愛上！</h1>
            <p data-aos="fade-up" data-aos-delay="100">我們用心滷每一味，經典不敗的台灣好滋味。
            </p>
            <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
              <a href="#menu" class="btn-get-started">立即點餐</a>
              <!-- <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8"
                class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch
                  Video</span></a> -->
            </div>
          </div>
          <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
            <img src="assets/img/火鍋類/麻辣鴨血臭臭鍋.jpg" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->


    <!-- Stats Section -->
    <section id="stats" class="stats section dark-background">

      <img src="assets/img/封面照.jpg" alt="" data-aos="fade-in">

      <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1"
                class="purecounter"></span>
              <p>客戶</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1"
                class="purecounter"></span>
              <p>品項</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="1453" data-purecounter-duration="1"
                class="purecounter"></span>
              <p>支持時間</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="32" data-purecounter-duration="1"
                class="purecounter"></span>
              <p>訂購次數</p>
            </div>
          </div><!-- End Stats Item -->

        </div>

      </div>

    </section><!-- /Stats Section -->

    <!-- Menu Section -->
    <section id="menu" class="menu section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>菜單</h2>
        <p><span>經典滷味菜單</span> <span class="description-title">，馬上看！</span></p>
      </div><!-- End Section Title -->

      <div class="container">

        <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">

          <li class="nav-item">
            <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#menu-Hotpot">
              <h4>火鍋類</h4>
            </a>
          </li><!-- End tab nav item -->

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-Hotpotingredients">
              <h4>火鍋料類</h4>
            </a>
          </li><!-- End tab nav item -->

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-noodles">
              <h4>主食麵類</h4>
            </a><!-- End tab nav item -->

          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-primemeat">
              <h4>上等肉類</h4>
            </a>
          </li><!-- End tab nav item -->

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-Beans">
              <h4>豆品類</h4>
            </a>
          </li><!-- End tab nav item -->

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-wintervegetables">
              <h4>冬季蔬菜類</h4>
            </a>
          </li><!-- End tab nav item -->

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-Mushrooms">
              <h4>香菇類</h4>
            </a>
          </li><!-- End tab nav item -->

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-Other">
              <h4>其他類</h4>
            </a>
          </li><!-- End tab nav item -->

        </ul>

        <div class="tab-content" data-aos="fade-up" data-aos-delay="200">

          <div class="tab-pane fade show active" id="menu-Hotpot">
            <div class="tab-header text-center">
              <h3>火鍋類</h3>
            </div>
            <div class="row gy-5">
              <?php
              // 包含資料庫連線檔案
              include("db_connection.php");

              $query = "SELECT * FROM menu WHERE is_available = 1 AND category = '火鍋類' ORDER BY Menu_ID";
              $result = $conn->query($query);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  $menu_name = htmlspecialchars($row['Menu_name']);
                  $menu_price = number_format($row['sell_price'], 2);
                  $product_id = $row['Product_ID'];

                  // 查詢這個產品對應的食材名稱
                  $ingredient_query = "
                    SELECT DISTINCT i.Ingredient_name
                    FROM product p
                    JOIN hotpot h ON p.HotPot_ID = h.HotPot_ID
                    JOIN ingredient i ON h.Ingredient_ID = i.Ingredient_ID
                    WHERE p.Product_ID = $product_id
                  ";
                  $ingredient_result = $conn->query($ingredient_query);

                  $ingredient_list = [];
                  if ($ingredient_result->num_rows > 0) {
                    while ($ing = $ingredient_result->fetch_assoc()) {
                      $ingredient_list[] = $ing['Ingredient_name'];
                    }
                  }

                  // 將食材用逗號分隔列出
                  $ingredient_string = htmlspecialchars(implode(', ', $ingredient_list));

                  echo '<div class="col-6 col-lg-4 menu-item">';
                  if ($menu_name == "麻辣鴨血臭臭鍋") {
                    echo '<a href="./assets/img/火鍋類/麻辣鴨血臭臭鍋.jpg" class="glightbox"><img src="./assets/img/火鍋類/麻辣鴨血臭臭鍋.jpg" class="menu-img img-fluid" alt=""></a>';
                  } else {
                    echo '<a href="./assets/img/暫無圖片.png" class="glightbox"><img src="./assets/img/暫無圖片.png" class="menu-img img-fluid" alt=""></a>';
                  }
                  echo '<h4>' . $menu_name . '</h4>';
                  echo '<p class="ingredients text-truncate" onclick="this.classList.toggle(\'expanded\')" title="點擊展開 / 收合">' . $ingredient_string . '</p>';
                  echo '<p class="price">$' . $menu_price . '</p>';
                  echo '<button class="btn btn-outline-danger col-lg-6" onclick="showSuccessToast()" data-name="' . $menu_name . '" data-price="' . $row['sell_price'] . '">加入購物車</button>';
                  echo '</div><!-- Menu Item -->';
                }
              } else {
                echo '<div class="col-12 text-center"><p>目前沒有可用的菜單項目</p></div>';
              }

              ?>
            </div>
          </div><!-- End 火鍋類 Menu Content -->

          <div class="tab-pane fade" id="menu-Hotpotingredients">
            <div class="tab-header text-center">
              <h3>火鍋料類</h3>
            </div>
            <div class="row gy-5">
              <?php
              $query = "SELECT * FROM menu WHERE is_available= 1 and category='火鍋料類' ORDER BY Menu_ID";
              $result = $conn->query($query);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo '<div class="col-6 col-lg-4 menu-item">';
                  $imagePath = './assets/img/火鍋料類/' . $row['Menu_name'] . '.jpg';
                  if (file_exists($imagePath)) {
                    echo '<a href="' . $imagePath . '" class="glightbox"><img src="' . $imagePath . '" class="menu-img img-fluid" alt=""></a>';
                  } else {
                    echo '<a href="./assets/img/暫無圖片.png" class="glightbox"><img src="./assets/img/暫無圖片.png" class="menu-img img-fluid" alt=""></a>';
                  }
                  echo '<h4>' . htmlspecialchars($row['Menu_name']) . '</h4>';
                  // echo '<p class="ingredients"> Lorem, deren, trataro, filede, nerada </p>';
                  echo '<p class="price">$' . number_format($row['sell_price'], 2) . '</p>';
                  echo '<button class="btn btn-outline-danger col-lg-6" onclick="showSuccessToast()" data-name="' . htmlspecialchars($row['Menu_name']) . '" data-price="' . $row['sell_price'] . '">加入購物車</button>';
                  echo '</div><!-- Menu Item -->';
                }
              } else {
                echo '<div class="col-12 text-center"><p>目前沒有可用的菜單項目</p></div>';
              }
              ?>
            </div>
          </div><!-- End 火鍋料類 Menu Content -->

          <div class="tab-pane fade" id="menu-noodles">
            <div class="tab-header text-center">
              <h3>主食麵類</h3>
            </div>
            <div class="row gy-5">
              <?php
              $query = "SELECT * FROM menu WHERE is_available= 1 and category='主食麵類' ORDER BY Menu_ID";
              $result = $conn->query($query);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo '<div class="col-6 col-lg-4 menu-item">';
                  $imagePath = './assets/img/主食麵類/' . $row['Menu_name'] . '.jpg';
                  if (file_exists($imagePath)) {
                    echo '<a href="' . $imagePath . '" class="glightbox"><img src="' . $imagePath . '" class="menu-img img-fluid" alt=""></a>';
                  } else {
                    echo '<a href="./assets/img/暫無圖片.png" class="glightbox"><img src="./assets/img/暫無圖片.png" class="menu-img img-fluid" alt=""></a>';
                  }
                  echo '<h4>' . htmlspecialchars($row['Menu_name']) . '</h4>';
                  // echo '<p class="ingredients"> Lorem, deren, trataro, filede, nerada </p>';
                  echo '<p class="price">$' . number_format($row['sell_price'], 2) . '</p>';
                  echo '<button class="btn btn-outline-danger col-lg-6" onclick="showSuccessToast()" data-name="' . htmlspecialchars($row['Menu_name']) . '" data-price="' . $row['sell_price'] . '">加入購物車</button>';
                  echo '</div><!-- Menu Item -->';
                }
              } else {
                echo '<div class="col-12 text-center"><p>目前沒有可用的菜單項目</p></div>';
              }
              ?>
            </div>
          </div><!-- End 主食麵類 Menu Content -->

          <div class="tab-pane fade" id="menu-primemeat">
            <div class="tab-header text-center">
              <h3>上等肉類</h3>
            </div>
            <div class="row gy-5">
              <?php
              $query = "SELECT * FROM menu WHERE is_available= 1 and category='上等肉類' ORDER BY Menu_ID";
              $result = $conn->query($query);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo '<div class="col-6 col-lg-4 menu-item">';
                  $imagePath = './assets/img/上等肉類/' . $row['Menu_name'] . '.jpg';
                  if (file_exists($imagePath)) {
                    echo '<a href="' . $imagePath . '" class="glightbox"><img src="' . $imagePath . '" class="menu-img img-fluid" alt=""></a>';
                  } else {
                    echo '<a href="./assets/img/暫無圖片.png" class="glightbox"><img src="./assets/img/暫無圖片.png" class="menu-img img-fluid" alt=""></a>';
                  }
                  echo '<h4>' . htmlspecialchars($row['Menu_name']) . '</h4>';
                  // echo '<p class="ingredients"> Lorem, deren, trataro, filede, nerada </p>';
                  echo '<p class="price">$' . number_format($row['sell_price'], 2) . '</p>';
                  echo '<button class="btn btn-outline-danger col-lg-6" onclick="showSuccessToast()" data-name="' . htmlspecialchars($row['Menu_name']) . '" data-price="' . $row['sell_price'] . '">加入購物車</button>';
                  echo '</div><!-- Menu Item -->';
                }
              } else {
                echo '<div class="col-12 text-center"><p>目前沒有可用的菜單項目</p></div>';
              }
              ?>
            </div>
          </div><!-- End 上等肉類 Menu Content -->

          <div class="tab-pane fade" id="menu-Beans">
            <div class="tab-header text-center">
              <h3>豆品類</h3>
            </div>
            <div class="row gy-5">
              <?php
              $query = "SELECT * FROM menu WHERE is_available= 1 and category='豆品類' ORDER BY Menu_ID";
              $result = $conn->query($query);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo '<div class="col-6 col-lg-4 menu-item">';
                  $imagePath = './assets/img/豆品類/' . $row['Menu_name'] . '.jpg';
                  if (file_exists($imagePath)) {
                    echo '<a href="' . $imagePath . '" class="glightbox"><img src="' . $imagePath . '" class="menu-img img-fluid" alt=""></a>';
                  } else {
                    echo '<a href="./assets/img/暫無圖片.png" class="glightbox"><img src="./assets/img/暫無圖片.png" class="menu-img img-fluid" alt=""></a>';
                  }
                  echo '<h4>' . htmlspecialchars($row['Menu_name']) . '</h4>';
                  // echo '<p class="ingredients"> Lorem, deren, trataro, filede, nerada </p>';
                  echo '<p class="price">$' . number_format($row['sell_price'], 2) . '</p>';
                  echo '<button class="btn btn-outline-danger col-lg-6" onclick="showSuccessToast()" data-name="' . htmlspecialchars($row['Menu_name']) . '" data-price="' . $row['sell_price'] . '">加入購物車</button>';
                  echo '</div><!-- Menu Item -->';
                }
              } else {
                echo '<div class="col-12 text-center"><p>目前沒有可用的菜單項目</p></div>';
              }
              ?>
            </div>
          </div><!-- End 豆品類 Menu Content -->

          <div class="tab-pane fade" id="menu-wintervegetables">
            <div class="tab-header text-center">
              <h3>冬季蔬菜類</h3>
            </div>
            <div class="row gy-5">
              <?php
              $query = "SELECT * FROM menu WHERE is_available= 1 and category='冬季蔬菜類' ORDER BY Menu_ID";
              $result = $conn->query($query);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo '<div class="col-6 col-lg-4 menu-item">';
                  $imagePath = './assets/img/冬季蔬菜類/' . $row['Menu_name'] . '.jpg';
                  if (file_exists($imagePath)) {
                    echo '<a href="' . $imagePath . '" class="glightbox"><img src="' . $imagePath . '" class="menu-img img-fluid" alt=""></a>';
                  } else {
                    echo '<a href="./assets/img/暫無圖片.png" class="glightbox"><img src="./assets/img/暫無圖片.png" class="menu-img img-fluid" alt=""></a>';
                  }
                  echo '<h4>' . htmlspecialchars($row['Menu_name']) . '</h4>';
                  // echo '<p class="ingredients"> Lorem, deren, trataro, filede, nerada </p>';
                  echo '<p class="price">$' . number_format($row['sell_price'], 2) . '</p>';
                  echo '<button class="btn btn-outline-danger col-lg-6" onclick="showSuccessToast()" data-name="' . htmlspecialchars($row['Menu_name']) . '" data-price="' . $row['sell_price'] . '">加入購物車</button>';
                  echo '</div><!-- Menu Item -->';
                }
              } else {
                echo '<div class="col-12 text-center"><p>目前沒有可用的菜單項目</p></div>';
              }
              ?>
            </div>
          </div><!-- End 冬季蔬菜類 Menu Content -->

          <div class="tab-pane fade" id="menu-Mushrooms">
            <div class="tab-header text-center">
              <h3>香菇類</h3>
            </div>
            <div class="row gy-5">
              <?php
              $query = "SELECT * FROM menu WHERE is_available= 1 and category='香菇類' ORDER BY Menu_ID";
              $result = $conn->query($query);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo '<div class="col-6 col-lg-4 menu-item">';
                  $imagePath = './assets/img/香菇類/' . $row['Menu_name'] . '.jpg';
                  if (file_exists($imagePath)) {
                    echo '<a href="' . $imagePath . '" class="glightbox"><img src="' . $imagePath . '" class="menu-img img-fluid" alt=""></a>';
                  } else {
                    echo '<a href="./assets/img/暫無圖片.png" class="glightbox"><img src="./assets/img/暫無圖片.png" class="menu-img img-fluid" alt=""></a>';
                  }
                  echo '<h4>' . htmlspecialchars($row['Menu_name']) . '</h4>';
                  // echo '<p class="ingredients"> Lorem, deren, trataro, filede, nerada </p>';
                  echo '<p class="price">$' . number_format($row['sell_price'], 2) . '</p>';
                  echo '<button class="btn btn-outline-danger col-lg-6" onclick="showSuccessToast()" data-name="' . htmlspecialchars($row['Menu_name']) . '" data-price="' . $row['sell_price'] . '">加入購物車</button>';
                  echo '</div><!-- Menu Item -->';
                }
              } else {
                echo '<div class="col-12 text-center"><p>目前沒有可用的菜單項目</p></div>';
              }
              ?>
            </div>
          </div><!-- End 香菇類 Menu Content -->

          <div class="tab-pane fade" id="menu-Other">
            <div class="tab-header text-center">
              <h3>其他類</h3>
            </div>
            <div class="row gy-5">
              <?php
              $query = "SELECT * FROM menu WHERE is_available= 1 and category='其他類' ORDER BY Menu_ID";
              $result = $conn->query($query);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo '<div class="col-6 col-lg-4 menu-item">';
                  $imagePath = './assets/img/其他類/' . $row['Menu_name'] . '.jpg';
                  if (file_exists($imagePath)) {
                    echo '<a href="' . $imagePath . '" class="glightbox"><img src="' . $imagePath . '" class="menu-img img-fluid" alt=""></a>';
                  } else {
                    echo '<a href="./assets/img/暫無圖片.png" class="glightbox"><img src="./assets/img/暫無圖片.png" class="menu-img img-fluid" alt=""></a>';
                  }
                  echo '<h4>' . htmlspecialchars($row['Menu_name']) . '</h4>';
                  // echo '<p class="ingredients"> Lorem, deren, trataro, filede, nerada </p>';
                  echo '<p class="price">$' . number_format($row['sell_price'], 2) . '</p>';
                  echo '<button class="btn btn-outline-danger col-lg-6" onclick="showSuccessToast()" data-name="' . htmlspecialchars($row['Menu_name']) . '" data-price="' . $row['sell_price'] . '">加入購物車</button>';
                  echo '</div><!-- Menu Item -->';
                }
              } else {
                echo '<div class="col-12 text-center"><p>目前沒有可用的菜單項目</p></div>';
              }
              ?>
            </div>
          </div><!-- End 其他類 Menu Content -->

        </div>
      </div>
      <?php
      // 關閉資料庫連線
      $conn->close();
      ?>
    </section><!-- /Menu Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>客戶評價</h2>
        <p>What Are They <span class="description-title">Saying About Us</span></p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              }
            }
          </script>
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="row gy-4 justify-content-center">
                  <div class="col-lg-6">
                    <div class="testimonial-content">
                      <p>
                        <i class="bi bi-quote quote-icon-left"></i>
                        <span>Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus.
                          Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at
                          semper.</span>
                        <i class="bi bi-quote quote-icon-right"></i>
                      </p>
                      <h3>Saul Goodman</h3>
                      <h4>Ceo &amp; Founder</h4>
                      <div class="stars">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                          class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 text-center">
                    <img src="assets/img/testimonials/testimonials-1.jpg" class="img-fluid testimonial-img" alt="">
                  </div>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="row gy-4 justify-content-center">
                  <div class="col-lg-6">
                    <div class="testimonial-content">
                      <p>
                        <i class="bi bi-quote quote-icon-left"></i>
                        <span>Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum
                          eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim
                          culpa.</span>
                        <i class="bi bi-quote quote-icon-right"></i>
                      </p>
                      <h3>Sara Wilsson</h3>
                      <h4>Designer</h4>
                      <div class="stars">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                          class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 text-center">
                    <img src="assets/img/testimonials/testimonials-2.jpg" class="img-fluid testimonial-img" alt="">
                  </div>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="row gy-4 justify-content-center">
                  <div class="col-lg-6">
                    <div class="testimonial-content">
                      <p>
                        <i class="bi bi-quote quote-icon-left"></i>
                        <span>Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam
                          duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.</span>
                        <i class="bi bi-quote quote-icon-right"></i>
                      </p>
                      <h3>Jena Karlis</h3>
                      <h4>Store Owner</h4>
                      <div class="stars">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                          class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 text-center">
                    <img src="assets/img/testimonials/testimonials-3.jpg" class="img-fluid testimonial-img" alt="">
                  </div>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="row gy-4 justify-content-center">
                  <div class="col-lg-6">
                    <div class="testimonial-content">
                      <p>
                        <i class="bi bi-quote quote-icon-left"></i>
                        <span>Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat
                          minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore
                          illum veniam.</span>
                        <i class="bi bi-quote quote-icon-right"></i>
                      </p>
                      <h3>John Larson</h3>
                      <h4>Entrepreneur</h4>
                      <div class="stars">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                          class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 text-center">
                    <img src="assets/img/testimonials/testimonials-4.jpg" class="img-fluid testimonial-img" alt="">
                  </div>
                </div>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section><!-- /Testimonials Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>關於</h2>
        <p><span>餐廳</span> <span class="description-title">資訊</span></p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="mb-5">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d227.6027079710158!2d120.6531884422449!3d24.11403541516385!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x34693dd422cd8333%3A0x4d71a46ba216ff50!2z5aSn5oW25ru35ZGz77yI5aSn5oW25bqX77yJ!5e0!3m2!1szh-TW!2stw!4v1743922172232!5m2!1szh-TW!2stw"
            style="width: 100%; height: 400px;" frameborder="0" allowfullscreen=""></iframe>
        </div><!-- End Google Maps -->

        <div class="row gy-4">

          <div class="col-md-6">
            <div class="info-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="200">
              <i class="icon bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>地址</h3>
                <p>台中市南區大慶街二段2-5號</p>
              </div>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-6">
            <div class="info-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="300">
              <i class="icon bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>致電我們</h3>
                <p>0907 328 416</p>
              </div>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-6">
            <div class="info-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="400">
              <i class="icon bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>電子郵件</h3>
                <p>info@example.com</p>
              </div>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-6">
            <div class="info-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="500">
              <i class="icon bi bi-clock flex-shrink-0"></i>
              <div>
                <h3>營業時間<br></h3>
                <p><strong>星期一 - 星期五:</strong> 16:30 - 23:30 </p>
              </div>
            </div>
          </div><!-- End Info Item -->

        </div>

      </div>

    </section><!-- /Contact Section -->
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
    <!-- <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Yummy</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div> -->
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <!-- SweetAlert2 CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js" async></script>
</body>

</html>