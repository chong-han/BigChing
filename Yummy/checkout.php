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
          <h2>訂單備注</h2>
          <p><span class="description-title">訂單備注</span></p>
        </div><!-- End Section Title -->
        <div class="container" data-aos="fade-up" data-aos-delay="100">
          <!-- 辣度 -->
          <fieldset class="form-group mb-4">
            <legend class="mb-2">請選擇辣度：</legend>
            <div class="d-flex flex-wrap gap-2">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="無" name="spiciness" value="無" required checked>
                <label for="無" class="form-check-label">無</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="再微辣" name="spiciness" value="再微辣" required>
                <label for="再微辣" class="form-check-label">再微辣</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="微辣" name="spiciness" value="微辣" required>
                <label for="微辣" class="form-check-label">微辣</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="小辣" name="spiciness" value="小辣" required>
                <label for="小辣" class="form-check-label">小辣</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="中辣" name="spiciness" value="中辣" required>
                <label for="中辣" class="form-check-label">中辣</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="中小辣" name="spiciness" value="中小辣" required>
                <label for="中小辣" class="form-check-label">中小辣</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="包辣" name="spiciness" value="包辣" required>
                <label for="包辣" class="form-check-label">包辣</label>
              </div>
            </div>
          </fieldset>

          <!-- 口味 -->
          <fieldset class="form-group mb-4">
            <legend class="mb-2">請選擇口味：</legend>
            <div class="d-flex flex-wrap gap-2">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="重" name="flavor" value="重" required checked>
                <label for="重" class="form-check-label">重</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="清淡" name="flavor" value="清淡" required>
                <label for="清淡" class="form-check-label">清淡</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="不加醬" name="flavor" value="不加醬" required>
                <label for="不加醬" class="form-check-label">不加醬</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="麻辣" name="flavor" value="麻辣" required>
                <label for="麻辣" class="form-check-label">麻辣</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="豚骨" name="flavor" value="豚骨" required>
                <label for="豚骨" class="form-check-label">豚骨</label>
              </div>
            </div>
          </fieldset>

          <!-- 作法 -->
          <fieldset class="form-group mb-4">
            <legend class="mb-2">請選擇作法：</legend>
            <div class="d-flex flex-wrap gap-2">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="乾" name="preparation" value="乾" required>
                <label for="乾" class="form-check-label">乾</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="半湯" name="preparation" value="半湯" required>
                <label for="半湯" class="form-check-label">半湯</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="全湯" name="preparation" value="全湯" required checked>
                <label for="全湯" class="form-check-label">全湯</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="包湯" name="preparation" value="包湯" required>
                <label for="包湯" class="form-check-label">包湯</label>
              </div>
            </div>
          </fieldset>

          <!-- 配料 -->
          <fieldset class="form-group mb-4">
            <legend class="mb-2">配料內容：</legend>

            <!-- 蔥 -->
            <div class="mb-2">
              <label class="form-label">蔥：</label>
              <div class="d-flex flex-wrap gap-2">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" id="多蔥" name="scallion_option" value="多蔥" required>
                  <label for="多蔥" class="form-check-label">多蔥</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" id="不加蔥" name="scallion_option" value="不加蔥" required checked>
                  <label for="不加蔥" class="form-check-label">不加蔥</label>
                </div>
              </div>
            </div>

            <!-- 酸菜 -->
            <div class="mb-2">
              <label class="form-label">酸菜：</label>
              <div class="d-flex flex-wrap gap-2">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" id="多加" name="pickled_cabbage_option" value="多加酸菜" required>
                  <label for="多加" class="form-check-label">多加</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" id="不加" name="pickled_cabbage_option" value="不加酸菜" required checked>
                  <label for="不加" class="form-check-label">不加</label>
                </div>
              </div>
            </div>
          </fieldset>
        </div>

        <div class="container section-title" data-aos="fade-up">
          <h2>取餐時間</h2>
          <p><span class="description-title">您的取餐時間</span></p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
          <fieldset class="form-group mb-4">
            <legend class="mb-2">請選擇取餐時間：</legend>
            <div class="d-flex flex-wrap gap-2">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="pickup_option" id="now" value="now" required checked>
                <label class="form-check-label" for="now">現在取餐</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="pickup_option" id="custom" value="custom" required>
                <label class="form-check-label" for="custom">自訂取餐時間</label>
              </div>
            </div>

            <!-- 自訂時間區塊 -->
            <div id="custom-time-inputs" class="mt-2" style="display: none;">
              <label for="pickup_datetime" class="form-label">選擇日期與時間：</label>
              <input type="datetime-local" id="pickup_datetime" name="pickup_datetime" class="form-control">
            </div>
          </fieldset>
        </div>


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
              <input type="tel" class="form-control" id="phone" name="phone" placeholder="請輸入聯絡電話" required
                pattern="09\d{8}" title="請輸入正確的手機格式，例如 0912345678">
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- SweetAlert2 CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    // 延時提交
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

    // 顯示或隱藏自訂時間區塊
    document.addEventListener('DOMContentLoaded', function() {
      const nowRadio = document.getElementById('now');
      const customRadio = document.getElementById('custom');
      const customInputs = document.getElementById('custom-time-inputs');
      const datetimeInput = document.getElementById('pickup_datetime');

      function toggleCustomTime() {
        if (customRadio.checked) {
          customInputs.style.display = 'block';
          datetimeInput.setAttribute('required', 'required');
        } else {
          customInputs.style.display = 'none';
          datetimeInput.removeAttribute('required');
          datetimeInput.value = ''; // 清空值避免提交舊資料
        }
      }

      nowRadio.addEventListener('change', toggleCustomTime);
      customRadio.addEventListener('change', toggleCustomTime);
      toggleCustomTime(); // 初始化狀態
    });
  </script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>