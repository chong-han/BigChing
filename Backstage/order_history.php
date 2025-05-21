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
  <title>MAMA後台</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <link rel="stylesheet" href="assets/css/main.css" />
  <link rel="stylesheet" href="assets/css/order.css" />
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
          <span class="image avatar48"><img src="images/LOGO.jpg" alt="" /></span>
        </div>
        <div class="content">
          <h1 id="title">瑪利MAMA</h1>
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
        <span>取貨日期：<span id="delivery-date-placeholder"></span>&nbsp;-&nbsp;星期四</span>
        <span>累計金額：<span id="total-amount">0</span>元</span>
    </div>

    <!-- 显示订单记录卡片 --> 
    <div class="feedback-container">
    <?php
        // 你的数据库连接代码（与原始代码相同）
        // 連接到資料庫
        // 連接到資料庫
        include("db_connection.php"); 

        // 检索 orders_record 表的数据
        $sql_orders = "SELECT * FROM orders_record";
        $result_orders = $conn->query($sql_orders);

        while ($row = $result_orders->fetch_assoc()) {
            // 获取订单记录的信息
            $purchase_time = $row['purchase_time'];
            $memberNumber = $row['memberNumber'];
            $Total_Amount = $row['Total_Amount'];
            $current_state = $row['current_state'];

            // 获取订单项的信息
            $sql_items = "SELECT * FROM order_items WHERE re_id = " . $row['re_id'];
            $result_items = $conn->query($sql_items);

            // 输出订单记录的卡片
            echo '<div class="feedback-card">';
            echo '<div class="feedback-header">';
            echo '<div class="feedback-company">瑪利MAMA</div>';
            echo '<div class="feedback-date">' . $purchase_time . '</div>';
            echo '</div>';
            echo '<div class="feedback-content">';
            echo '<h4>會員編號: ' . $memberNumber . '</h4>';
            // 在订单记录卡片中顯示姓名
            $sql = "SELECT `name` FROM `members` WHERE `membership_number` = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("i", $memberNumber); // 假設 `membership_number` 是整數
                $stmt->execute();
                $stmt->bind_result($name);
                $stmt->fetch();
                $stmt->close();

                if ($name) {
                    echo '<h5>姓名: ' . $name . '</h5>';
                } else {
                    echo '<h5>姓名: 找不到會員(可能已被刪除)</h5>';
                }
            } else {
                echo "查詢失敗: " . $conn->error;
            }
            echo '<div class="feedback-info">';
            echo '<p>總金額: ' . $Total_Amount . '</p>';
            echo '<p><span class="status" data-status="' . $current_state . '">' . $current_state . '</span></p>';
            echo '</div>';
            echo '<table>';
            echo '<tr>';
            echo '<th>購買品項</th>';
            echo '<th>是否分切</th>';
            echo '<th>數量</th>';
            echo '</tr>';

            // 输出订单项的信息
            while ($item = $result_items->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $item['Product_Name'] . '</td>';
                echo '<td>' . $item['Divided'] . '</td>';
                echo '<td>' . $item['Quantity'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';

            $prev_re_id = $row['re_id'];

            // 查询 order_items 表以获取正确的 Compilation 和 Note_Content
            $sql_order_items = "SELECT `Compilation`, `Note_Content` FROM `order_items` WHERE `re_id` = ?";
            if ($stmt = $conn->prepare($sql_order_items)) {
                $stmt->bind_param("i", $prev_re_id); // 假设 re_id 是整数
                $stmt->execute();
                $stmt->bind_result($Compilation, $Note_Content);
                $stmt->fetch();
                $stmt->close();
        
                // 在订单记录卡片中显示 Compilation 和 Note_Content
                if ($Compilation !== null) {
                    echo '<h3>統編：' . $Compilation . '</h3>';
                } else {
                    echo '<h3>統編：無</h3>';
                }
        
                if ($Note_Content !== null) {
                    echo '<h2>備註：' . $Note_Content . '</h2>';
                } else {
                    echo '<h2>備註：無</h2>';
                }
            } else {
                echo "查詢失敗: " . $conn->error;
            }
            
            // 如果 $current_state 是 "未完成"，則顯示按鈕
            if ($current_state !== "已完成") {
              echo '<div class="button-container">';
              echo '<button class="edit-button">完成</button>';
              echo '<button class="cancel-button">刪除</button>';
              echo '</div>';
            }
            echo '</div>';
            echo '</div>';
        }
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

    // 在导向的页面中获取传递的登录状态
    const username = document.querySelector('a#portfolio-link').getAttribute('data-username');


    $(document).ready(function () {
      // 点击图标时执行滚动到顶部的动作
      $("#scroll-to-top").click(function () {
        $("html, body").animate({ scrollTop: 0 }, "slow");
      });
    });

    document.addEventListener("DOMContentLoaded", function() {
          var orderCards = document.querySelectorAll(".feedback-card");

          orderCards.forEach(function(card) {
              var statusElement = card.querySelector(".status");
              if (statusElement) {
                  var currentStatus = statusElement.getAttribute("data-status");
                  if (currentStatus === "未完成") {
                      card.style.display = "block"; // 显示未完成的卡片
                  } else {
                      card.style.display = "none"; // 隐藏其他卡片
                  }
              }
          });

          // 解析 URL 中的 memberId 参数
          var urlParams = new URLSearchParams(window.location.search);
          var memberId = urlParams.get("memberId");

          // 执行操作，例如根据 memberId 进行查询或其他操作
          if (memberId) {
              // 隐藏取貨日期内容
              var deliveryDate = document.querySelector(".summary span:first-child");
              deliveryDate.classList.add("hide-delivery-date");

              // 获取点击的訂購者姓名
              var clickedOrderer = memberId; // 根据 memberID 获取对应的订购者姓名

              // 获取所有订单记录卡片
              var orderCards = document.querySelectorAll('.feedback-card');

              // 计算新的总金额和匹配的订单数量
              var newTotalAmount = 0;
              var matchedOrderCount = 0;

              // 为未完成的订单卡片创建一个数组
              var unfinishedOrderCards = [];

              orderCards.forEach(function (card) {
                  // 获取订单卡片的订购者
                  var cardOrderer = card.querySelector('h4').textContent.replace('會員編號: ', '');

                  // 获取订单卡片的状态
                  var statusElement = card.querySelector('.status');
                  var cardStatus = statusElement ? statusElement.getAttribute('data-status') : '';

                  // 获取订单卡片的金额
                  var amountElement = card.querySelector('.feedback-info p');
                  var cardAmount = 0;

                  if (amountElement) {
                      var text = amountElement.textContent;
                      if (text.includes('總金額')) {
                          cardAmount = parseFloat(text.match(/[\d.]+/));
                      }
                  }

                  if (cardOrderer === clickedOrderer) {
                      // 显示匹配的订单卡片
                      card.style.display = 'block';

                      // 更新总金额
                      newTotalAmount += cardAmount;
                      matchedOrderCount++;

                      if (cardStatus === '未完成') {
                          // 如果状态为"未完成"，将订单卡片添加到未完成订单数组
                          unfinishedOrderCards.push(card);
                      }
                  } else {
                      // 隐藏不匹配的订单卡片
                      card.style.display = 'none';
                  }
              });

              // 将值为"未完成"的订单记录卡片排列在顶部
              unfinishedOrderCards.forEach(function (card) {
                  document.querySelector('.feedback-container').insertBefore(card, document.querySelector('.feedback-container').firstChild);
              });

              // 更新累計金額
              var totalAmountElement = document.getElementById('total-amount');
              totalAmountElement.textContent = newTotalAmount.toFixed(2);

              // 更新页面的其他相关内容（例如：订单数量等）
              updateOtherInfo(matchedOrderCount);

              console.log("Received memberId: " + memberId);
          } else {
              console.log("No memberId parameter found in the URL.");
          }

     });


    // 获取当前日期
    var currentDate = new Date();

    // 计算当前星期几 (0 表示星期日，1 表示星期一，以此类推)
    var currentDayOfWeek = currentDate.getDay();

    // 计算到下一个星期四还有多少天
    var daysUntilNextThursday = 4 - currentDayOfWeek;
    if (daysUntilNextThursday <= 0) {
        daysUntilNextThursday += 7; // 如果今天已经是星期四，则跳到下个星期四
    }

    // 计算下一个星期四的日期
    var nextThursdayDate = new Date(currentDate);
    nextThursdayDate.setDate(currentDate.getDate() + daysUntilNextThursday);

    // 将日期格式化为所需的格式 (例如: "YYYY-MM-DD")
    var formattedDate = nextThursdayDate.getFullYear() + "-" + (nextThursdayDate.getMonth() + 1) + "-" + nextThursdayDate.getDate();

    // 将日期插入到页面中
    document.getElementById("delivery-date-placeholder").textContent = formattedDate;


    // 为"訂購者"标题添加事件监听器
    document.querySelectorAll('.feedback-card h4').forEach(function(ordererTitle) {
      ordererTitle.addEventListener('click', function() {

        // 隐藏取貨日期内容
        var deliveryDate = document.querySelector(".summary span:first-child");
        deliveryDate.classList.add("hide-delivery-date");
        
        // 获取点击的訂購者姓名
        var clickedOrderer = ordererTitle.textContent.replace('訂購者: ', '');

        // 获取所有订单记录卡片
        var orderCards = document.querySelectorAll('.feedback-card');

        // 计算新的总金额和匹配的订单数量
        var newTotalAmount = 0;
        var matchedOrderCount = 0;

        // 为未完成的订单卡片创建一个数组
        var unfinishedOrderCards = [];

        orderCards.forEach(function(card) {
          // 获取订单卡片的订购者
          var cardOrderer = card.querySelector('h4').textContent.replace('訂購者: ', '');

          // 获取订单卡片的状态
          var statusElement = card.querySelector('.status');
          var cardStatus = statusElement ? statusElement.getAttribute('data-status') : '';

          // 获取订单卡片的金额
          var amountElement = card.querySelector('.feedback-info p');
          var cardAmount = 0;

          if (amountElement) {
            var text = amountElement.textContent;
            if (text.includes('總金額')) {
              cardAmount = parseFloat(text.match(/[\d.]+/));
            }
          }

          if (cardOrderer === clickedOrderer) {
            // 显示匹配的订单卡片
            card.style.display = 'block';

            // 更新总金额
            newTotalAmount += cardAmount;
            matchedOrderCount++;

            if (cardStatus === '未完成') {
              // 如果状态为"未完成"，将订单卡片添加到未完成订单数组
              unfinishedOrderCards.push(card);
            }
          } else {
            // 隐藏不匹配的订单卡片
            card.style.display = 'none';
          }
        });

        // 将值为"未完成"的订单记录卡片排列在顶部
        unfinishedOrderCards.forEach(function(card) {
          document.querySelector('.feedback-container').insertBefore(card, document.querySelector('.feedback-container').firstChild);
        });

        // 更新累計金額
        var totalAmountElement = document.getElementById('total-amount');
        totalAmountElement.textContent = newTotalAmount.toFixed(2);

        // 更新页面的其他相关内容（例如：订单数量等）
        updateOtherInfo(matchedOrderCount);
      });
    });

    // 初始化页面时计算并显示未完成订单的总金额
    function calculateTotalAmount(status) {
      var orderCards = document.querySelectorAll(".feedback-card");
      var totalAmount = 0;

      orderCards.forEach(function(card) {
        var statusElement = card.querySelector(".status");
        if (statusElement) {
          var currentStatus = statusElement.getAttribute("data-status");
          if (currentStatus === status) {
            var totalAmountElements = card.querySelectorAll(".feedback-info p");
            totalAmountElements.forEach(function(element) {
              var text = element.textContent;
              if (text.includes("總金額")) {
                var amount = parseFloat(text.match(/[\d.]+/));
                if (!isNaN(amount)) {
                  totalAmount += amount;
                }
              }
            });
          }
        }
      });

      // 更新总金额
      var totalAmountElement = document.getElementById("total-amount");
      totalAmountElement.textContent = totalAmount.toFixed(2);
    }

    // 初始化页面时计算并显示未完成订单的总金额
    calculateTotalAmount("未完成");

    document.getElementById("search-button").addEventListener("click", function () {
        // 获取搜索关键字
        var keyword = document.getElementById("search-input").value.toLowerCase();

        // 如果搜索关键字为空，不执行搜索
        if (keyword === "") {
            document.getElementById("search-input").placeholder = "尚未輸入訂購人..."; // 更改提示文字
            return;
        }

        // 获取所有订单记录卡片
        var orderCards = document.querySelectorAll(".feedback-card");

        // 创建一个数组来存储符合搜索条件的卡片
        var matchingCards = [];

        // 创建一个空容器来存放不匹配的卡片
        var nonMatchingCards = [];

        // 遍历所有订单记录卡片，检查订单者名称和姓名是否包含搜索关键字
        orderCards.forEach(function (card) {
            var cardOrderer = card.querySelector("h4").textContent.toLowerCase();
            var cardName = card.querySelector("h5").textContent.toLowerCase(); // 获取姓名内容

            var cardContent = card.querySelector(".feedback-content"); // 获取 feedback-content 区块

            if (cardOrderer.includes(keyword) || cardName.includes(keyword)) {
                matchingCards.push(card);
                card.style.backgroundColor = "#4bfae876"; // 更改 feedback-content 的背景颜色
            } else {
                nonMatchingCards.push(card);
                card.style.backgroundColor = ""; // 清除 feedback-content 的背景颜色
            }
        });

        // 如果没有找到符合条件的订单记录，显示相应的提示
        if (matchingCards.length === 0) {
            document.getElementById("search-input").value = ""; // 清空输入框的值
            document.getElementById("search-input").placeholder = "查無此人，請重新輸入！"; // 更改提示文字
        } else {
            // 如果有符合条件的订单记录，将匹配的卡片插入容器的顶部
            matchingCards.forEach(function (card) {
                document.querySelector(".feedback-container").insertBefore(card, document.querySelector(".feedback-container").firstChild);
                document.getElementById("search-input").placeholder = "請輸入訂購人..."; // 更改提示文字
            });

            // 将不匹配的卡片插入容器的底部
            nonMatchingCards.forEach(function (card) {
                document.querySelector(".feedback-container").appendChild(card);
            });
        }
    });

    document.getElementById("add-product").addEventListener("click", function() {
        // 获取所有订单记录卡片
        calculateTotalAmount("未完成");
        // 恢复显示取貨日期内容
        var deliveryDate = document.querySelector(".summary span:first-child");
        deliveryDate.classList.remove("hide-delivery-date");

        // 移除累計金額的水平置中样式
        var totalAmount = document.getElementById("total-amount");
        totalAmount.classList.remove("center-total-amount");
        
        var orderCards = document.querySelectorAll(".feedback-card");

        // 遍历卡片并检查$current_state的值
        orderCards.forEach(function(card) {
            var statusElement = card.querySelector(".status");
            if (statusElement) {
                var currentStatus = statusElement.getAttribute("data-status");
                if (currentStatus === "已完成") {
                    card.style.display = "none"; // 隐藏已完成的卡片
                } else if (currentStatus === "未完成") {
                    card.style.display = "block"; // 显示未完成的卡片
                }
            }
        });
    });


    document.getElementById("add-product-past").addEventListener("click", function() {
        // 获取所有订单记录卡片
        var orderCards = document.querySelectorAll(".feedback-card");

        calculateTotalAmount("已完成");
        // 隐藏取貨日期内容
        var deliveryDate = document.querySelector(".summary span:first-child");
        deliveryDate.classList.add("hide-delivery-date");

        // 将累計金額内容水平置中
        var totalAmount = document.getElementById("total-amount");
        totalAmount.classList.add("center-total-amount");

        // 遍历卡片并检查$current_state的值
        orderCards.forEach(function(card) {
            var statusElement = card.querySelector(".status");
            if (statusElement) {
                var currentStatus = statusElement.getAttribute("data-status");
                if (currentStatus === "未完成") {
                    card.style.display = "none"; // 隐藏未完成的卡片
                } else if (currentStatus === "已完成") {
                    card.style.display = "block"; // 显示已完成的卡片
                }
            }
        });
     });

     document.querySelectorAll('.edit-button').forEach(function(button) {
      button.addEventListener('click', function() {
        // 获取需要的数据
        var purchaseTime = button.closest('.feedback-card').querySelector('.feedback-date').textContent;
        var orderer = button.closest('.feedback-card').querySelector('h4').textContent.replace('會員編號: ', '');
        var products = [];

        // 获取产品名称
        button.closest('.feedback-card').querySelectorAll('table td:first-child').forEach(function(td) {
          products.push(td.textContent);
        });

        // 创建包含数据的对象
        var data = {
          purchaseTime: purchaseTime,
          orderer: orderer,
          products: products
        };

        // 弹出SweetAlert2确认对话框
        Swal.fire({
          title: '完成訂單',
          text: '確定要完成 ' + orderer + ' 的訂單嗎？',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: '確定',
          cancelButtonText: '取消',
        }).then((result) => {
          if (result.isConfirmed) {
            // 成功后，发送数据到另一个PHP文件
            sendToServer(data);
          }
        });
      });
    });

    // 使用Ajax发送数据到另一个PHP文件
    function sendToServer(data) {
      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'process_orders.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          // 处理响应（如果有的话）
          if (xhr.responseText == 'success') {
            // 成功后的SweetAlert2弹窗
            Swal.fire('訂單已完成！', '', 'success').then(function() {
              // 刷新页面或执行其他操作
              location.reload();
            });
          } else {
            // 处理错误
            Swal.fire('操作失败', '请重试', 'error');
          }
        }
      };
      // 发送数据作为JSON
      var jsonData = JSON.stringify(data);
      xhr.send('data=' + jsonData);
    }


    // 为"删除"按钮添加事件监听器
    document.querySelectorAll('.cancel-button').forEach(function(button) {
        button.addEventListener('click', function() {
            // 获取需要的数据
            var purchaseTime = button.closest('.feedback-card').querySelector('.feedback-date').textContent;
            var orderer = button.closest('.feedback-card').querySelector('h4').textContent.replace('會員編號: ', '');
            var products = [];

            // 获取产品名称
            button.closest('.feedback-card').querySelectorAll('table td:first-child').forEach(function(td) {
                products.push(td.textContent);
            });

            // 创建包含数据的对象
            var data = {
                purchaseTime: purchaseTime,
                orderer: orderer,
                products: products
            };

            // 弹出SweetAlert2确认对话框
            Swal.fire({
                title: '刪除訂單',
                text: '確定要刪除 ' + orderer + ' 的訂單嗎？',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '確定',
                cancelButtonText: '取消',
            }).then((result) => {
                if (result.isConfirmed) {
                    // 成功后，发送数据到另一个PHP文件执行删除操作
                    deleteOrder(data);
                }
            });
        });
    });

    // 使用Ajax发送数据到另一个PHP文件执行删除操作
    function deleteOrder(data) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'delete_order.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // 处理响应（如果有的话）
                if (xhr.responseText == 'success') {
                    // 成功后的SweetAlert2弹窗
                    Swal.fire('訂單已刪除！', '', 'success').then(function() {
                        // 刷新页面或执行其他操作
                        location.reload();
                    });
                } else {
                    // 处理错误
                    Swal.fire('操作失败', '请重试', 'error');
                }
            }
        };
        // 发送数据作为JSON
        var jsonData = JSON.stringify(data);
        xhr.send('data=' + jsonData);
    }



      /// 导出按钮被点击时执行
      document.getElementById("advanced-search").addEventListener("click", function () {
          // 获取所有订单记录卡片
          var orderCards = document.querySelectorAll(".feedback-card");

          // 创建一个数组来存储要导出的数据
          var exportData = [];

          orderCards.forEach(function (card) {
              if (card.style.display !== "none") {
                  // 获取卡片中的各个数据
                  var purchaseTime = card.querySelector(".feedback-date").textContent.trim();
                  var orderer = card.querySelector("h4").textContent.replace("會員編號: ", "").trim();
                  var name = card.querySelector("h5").textContent.replace("姓名: ", "").trim();
                  var totalAmount = "";

                  // 新增这些变量以保存购买品项、是否分切、数量、统编和备注的信息
                  var purchaseItems = [];
                  var isCut = [];
                  var quantity = [];
                  var taxID = card.querySelector("h3").textContent.replace("統編：", "").trim();
                  var comments = card.querySelector("h2").textContent.replace("備註：", "").trim();

                  // 获取订单卡片的详细信息
                  var tableRows = card.querySelectorAll("table tr");
                  tableRows.forEach(function (row, index) {
                      if (index > 0) { // 跳过表头行
                          var columns = row.querySelectorAll("td");
                          if (columns.length === 3) {
                              // 添加购买品项、是否分切、数量的信息
                              purchaseItems.push(columns[0].textContent.trim());
                              isCut.push(columns[1].textContent.trim());
                              quantity.push(columns[2].textContent.trim());
                          }
                      }
                  });

                  // 获取统编和备注的信息
                  var infoParagraphs = card.querySelectorAll(".feedback-info p");
                  infoParagraphs.forEach(function (info) {
                      var text = info.textContent;
                      if (text.includes("總金額")) {
                          totalAmount = text.match(/[\d.]+/)[0];
                      }
                  });

                  // 计算最大的购买品项数量
                  var maxItems = Math.max(purchaseItems.length, isCut.length, quantity.length);

                  for (var i = 0; i < maxItems; i++) {
                      // 为每种购买品项创建一行数据
                      var rowData = [
                          i === 0 ? purchaseTime : "", // 只在第一行显示购买时间
                          i === 0 ? orderer : "", // 只在第一行显示订购者
                          i === 0 ? name : "", // 只在第一行显示姓名
                          i === 0 ? totalAmount : "", // 只在第一行显示总金额
                          purchaseItems[i] || "", // 根据索引获取购买品项或留空
                          isCut[i] || "", // 根据索引获取是否分切或留空
                          quantity[i] || "", // 根据索引获取数量或留空
                          i === 0 ? taxID : "", // 只在第一行显示统编
                          i === 0 ? comments : "" // 只在第一行显示备注
                      ];
                      exportData.push(rowData);
                  }
              }
          });

          // 创建一个工作簿
          var ws = XLSX.utils.aoa_to_sheet([
              ["訂購時間", "訂購者", "姓名", "總金額", "購買品項", "是否分切", "數量", "統編", "備註"]
          ].concat(exportData));

          // 创建一个工作簿容器
          var wb = XLSX.utils.book_new();
          XLSX.utils.book_append_sheet(wb, ws, "Order Records");

          // 导出工作簿为Excel文件
          XLSX.writeFile(wb, "OrderRecords.xlsx");
      });

  </script>

</body>
</html>