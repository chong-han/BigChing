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
          <li><a href="index.php#hero">首頁<br></a></li>
          <li><a href="index.php#menu">菜單</a></li>
          <li><a href="index.php#contact">關於</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      <a class="btn btn-getstarted p-2 px-md-4 pb-1 disabled" id="cart-btn" title="購物車">
        <i class='bx-fw bx bxs-cart bx-sm'></i>
      </a>

    </div>
  </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="container">
        <h1>結帳</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.php">首頁</a></li>
            <li class="current">結帳</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Starter Section Section -->
    <section id="starter-section" class="starter-section section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>訂單資訊</h2>
        <p><span class="description-title">您的訂單資訊</span></p>
      </div><!-- End Section Title -->
      <form action="order_send.php" method="POST"> <!-- 你可以根據需求修改 action -->
        <div class="container" data-aos="fade-up">
          <?php
          if (isset($_POST['item_name']) && is_array($_POST['item_name'])) {
            echo "<h3>商品清單：</h3>";
            echo "<table class='col-12 text-center' style='border-collapse: collapse;'>";
            echo "<thead>
              <tr>
                <th style='border:1px solid #ccc; padding:8px;'>品項</th>
                <th style='border:1px solid #ccc; padding:8px;'>單價</th>
                <th style='border:1px solid #ccc; padding:8px;'>數量</th>
                <th style='border:1px solid #ccc; padding:8px;'>小計</th>
              </tr>
            </thead>";
            echo "<tbody>";

            foreach ($_POST['item_name'] as $index => $itemName) {
              $itemPrice = isset($_POST['item_price'][$index]) ? $_POST['item_price'][$index] : 'N/A';
              $itemQty = isset($_POST['item_qty'][$index]) ? $_POST['item_qty'][$index] : 'N/A';
              $itemSubtotal = isset($_POST['item_subtotal'][$index]) ? $_POST['item_subtotal'][$index] : 'N/A';

              echo "<tr>";
              echo "<td style='border:1px solid #ccc; padding:8px;'>" . htmlspecialchars($itemName) . "</td>";
              echo "<td style='border:1px solid #ccc; padding:8px;'>NT$" . htmlspecialchars($itemPrice) . "</td>";
              echo "<td style='border:1px solid #ccc; padding:8px;'>" . htmlspecialchars($itemQty) . "</td>";
              echo "<td style='border:1px solid #ccc; padding:8px;'>NT$" . htmlspecialchars($itemSubtotal) . "</td>";
              echo "</tr>";

              // ✅ 隱藏欄位，讓商品資訊可以被送到 order_send.php
              echo '<input type="hidden" name="item_name[]" value="' . htmlspecialchars($itemName) . '">';
              echo '<input type="hidden" name="item_price[]" value="' . htmlspecialchars($itemPrice) . '">';
              echo '<input type="hidden" name="item_qty[]" value="' . htmlspecialchars($itemQty) . '">';
              echo '<input type="hidden" name="item_subtotal[]" value="' . htmlspecialchars($itemSubtotal) . '">';
            }

            echo "</tbody>";
            echo "</table>";
          } else {
            echo "<p>沒有收到商品資訊。</p>";
          }

          // 顯示總計
          if (isset($_POST['cart_total'])) {
            echo "<h3 class='mt-4'>總計：</h3>";
            echo "<p class='h5'><strong>NT$" . htmlspecialchars($_POST['cart_total']) . "</strong></p>";
          } else {
            echo "<p>沒有收到訂單總計。</p>";
          }
          ?>
        </div>

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          <h2>您的資訊</h2>
          <p><span class="description-title">您的結帳資訊</span></p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
          <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">姓名 <span style="color: red;">*</span></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="name" name="name" placeholder="請輸入姓名" required>
            </div>
          </div>

          <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">電子郵件</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="email" name="email" placeholder="請輸入電子郵件(選填)">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="phone" class="col-sm-2 col-form-label">電話 <span style="color: red;">*</span></label>
            <div class="col-sm-10">
              <input type="tel" class="form-control" id="phone" name="phone" placeholder="請輸入聯絡電話" required pattern="09\d{8}" title="請輸入正確的手機格式，例如 0912345678">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="payment" class="col-sm-2 col-form-label">付款方式 <span style="color: red;">*</span></label>
            <div class="col-sm-10">
              <select class="form-control" id="payment" name="payment" required>
                <option value="">請選擇付款方式</option>
                <option value="現金支付">現金支付</option>
                <option value="信用卡">信用卡</option>
                <option value="LINE Pay">LINE Pay</option>
                <option value="ATM轉帳">ATM轉帳</option>
              </select>
            </div>
          </div>



          <div class="mt-3">
            <input type="checkbox" id="agree" name="agree" required>
            <label for="agree">我已閱讀並同意 <a href="#">購買條款與退換貨政策</a></label>
          </div>

          <button class="btn btn-success col-12  col-md-3 mt-3 btn-block check_btn" type="submit">確認結帳</button>
        </div>
      </form>


    </section><!-- /Starter Section Section -->

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
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- 延時提交 -->
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

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>