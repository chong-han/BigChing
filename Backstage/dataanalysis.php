<?php


session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.html'); // 如果未登录，重定向到登录页面
    exit();
}


// 連接到資料庫
include("db_connection.php"); 

// 檢索 orders_record 表的數據
$sql_orders = "SELECT * FROM orders_record";
$result_orders = $conn->query($sql_orders);

// 檢索 feedback 表的數據
$sql_feedback = "SELECT * FROM feedback";
$result_feedback = $conn->query($sql_feedback);

// 檢索 question_answers 表的數據
$sql_questions = "SELECT * FROM question_answers";
$result_questions = $conn->query($sql_questions);

// 執行SQL查詢以計算未完成訂單的份數
$sql_drp = "SELECT COUNT(DISTINCT purchase_time, memberNumber) AS unfinished_orders FROM orders_record WHERE current_state = '未完成'";
$result = $conn->query($sql_drp);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $unfinishedOrders = $row["unfinished_orders"];
} else {
    $unfinishedOrders = 0;
}

// 檢索 orders_record 表的累計訂單數
$sql_total_orders = "SELECT COUNT(DISTINCT purchase_time, memberNumber) AS total_orders FROM orders_record";
$result_total_orders = $conn->query($sql_total_orders);

// 初始累計訂單數為0
$totalOrders = 0;

if ($result_total_orders->num_rows > 0) {
    $row = $result_total_orders->fetch_assoc();
    $totalOrders = $row["total_orders"];
}

// 檢索 orders_record 表的未完成訂單總金額
$sql_total_amount = "SELECT DISTINCT purchase_time, memberNumber, Total_Amount FROM orders_record WHERE current_state = '未完成'";
$result_total_amount = $conn->query($sql_total_amount);

// 初始總金額為0
$unfinishedTotalAmount = 0;

if ($result_total_amount->num_rows > 0) {
    while ($row = $result_total_amount->fetch_assoc()) {
        // 使用一份訂單的Total_Amount即可，因為它們相同
        $unfinishedTotalAmount += $row["Total_Amount"];
    }
}

// 檢索 orders_record 表的訂單總金額
$sql_total_amounts = "SELECT DISTINCT purchase_time, memberNumber, Total_Amount FROM orders_record";
$result_total_amounts = $conn->query($sql_total_amounts);

// 初始總金額為0
$totalAmounts = 0;

if ($result_total_amounts->num_rows > 0) {
    while ($row = $result_total_amounts->fetch_assoc()) {
        $totalAmounts += $row["Total_Amount"];
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
  <title>大慶滷味</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <link rel="stylesheet" href="assets/css/main.css" />
  <link rel="stylesheet" href="assets/css/dataanalysis.css" />
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

  <!-- Main -->
  <div id="main">
    <h2>數據分析管理</h2>

    <div id="scroll-to-top" class="scroll-to-top">
      <i class="fas fa-question-circle"></i> <!-- Q&A -->
    </div>
    <div id="add-product" class="scroll-to-top-2">
      <i class="fas fa-chart-pie"></i> <!--  排行榜 -->
    </div>
    <div id="advanced-search" class="scroll-to-top-3">
      <a class="scroll-to-top-3" href="#user-feedback">
         <i class="fas fa-comment-alt"></i> <!-- 回饋內容 -->
      </a>
    </div>

    <!-- 新增問題輸入框 -->
    <div id="custom-question" class="popup">
        <div class="popup-content">
            <!-- 問題輸入框 -->
            <div class="action-row">
                <label for="custom-question">問題Q：</label>
                <textarea id="custom-question" name="custom-question"></textarea>
            </div>
            <!-- 回答輸入框 -->
            <div class="action-row">
                <label for="custom-answer">回答A：</label>
                <textarea id="custom-answer" name="custom-answer"></textarea>
            </div>
            <!-- 確定和取消按鈕 -->
            <div class="action-buttons">
                <button id="confirm-button">新增</button>
                <button id="cancelc-button">取消</button>
            </div>
        </div>
    </div>

    <!-- 修改問題輸入框 -->
    <div id="edit-product-popup" class="popup">
        <div class="popup-content">
            <!-- 問題編號 -->
            <div class="action-row">
                <label for="edit-product-questioname">問題編號：</label>
                <input type="text" id="edit-product-questioname" name="edit-product-questioname" readonly>
            </div>
            <!-- 問題輸入框 -->
            <div class="action-row">
                <label for="edit-product-question">修改問題Q：</label>
                <textarea id="edit-product-question" name="edit-product-question"></textarea>
            </div>
            <!-- 回答輸入框 -->
            <div class="action-row">
                <label for="edit-product-answer">修改回答A：</label>
                <textarea id="edit-product-answer" name="edit-product-answer"></textarea>
            </div>
            <!-- 確定和取消按鈕 -->
            <div class="action-buttons">
                <button id="edit-product-confirm-button">修改</button>
                <button id="edit-product-cancel-button">取消</button>
            </div>
        </div>
    </div>

    <div id="overlay" class="overlay"></div>

    <div class="container">    
      <table class="custom-table">
        <tr>
          <td>本次訂單數</td>
          <td>本次交易金額</td>
        </tr>
        <tr>
          <td class="oz"><?php echo $unfinishedOrders; ?></td>
          <td class="oz"><?php echo $unfinishedTotalAmount; ?></td>
        </tr>
        <tr>
          <td>累計訂單數</td>
          <td>累計交易總額</td>
        </tr>
        <tr>
          <td class="oc"><?php echo $totalOrders; ?></td>
          <td class="oc"><?php echo $totalAmounts; ?></td>
        </tr>
      </table>

      <h1 class="bic">銷售排行榜</h1>
      <table>
        <tr>
          <th style="width: 30%;">排名</th>
          <th style="width: 35%;">產品名稱</th>
          <th style="width: 35%;">銷售總數</th>
        </tr>
            <?php
              // 檢索並分析銷售數量最多的產品
              // 檢索 order_items 表的產品銷售數量
              $sql_ranking = "SELECT Product_Name, SUM(Quantity) AS TotalQuantity
                            FROM order_items
                            GROUP BY Product_Name
                            ORDER BY TotalQuantity DESC";
              $result_ranking = $conn->query($sql_ranking);

              $rank = 1; // 用于跟踪排名

              while ($row = $result_ranking->fetch_assoc()) {
                  echo "<tr";
                    // 根据排名应用不同的样式
                    if ($rank <= 3) {
                        echo " class='top-three'";
                    }
                    echo ">";
                    if ($rank <= 3) {
                        // 前三名的排名添加不同的Font Awesome图标
                        $icon_class = ($rank == 1) ? "fa-trophy" : (($rank == 2) ? "fa-medal" : "fa-award");
                        echo "<td><i class='fas $icon_class'></i> 第 $rank 名</td>";
                    } else {
                        echo "<td>$rank</td>";
                    }
                  echo "<td>" . $row['Product_Name'] . "</td>";
                  echo "<td>" . $row['TotalQuantity'] . "</td>";
                  echo "</tr>";

                  $rank++;
              }

            ?>
      </table>
 
  <!-- 用戶回饋部分 -->
  <h1 class="bic" id="user-feedback">用戶回饋</h1>

  <div class="feedback-container">
      <?php
        while ($row = $result_feedback->fetch_assoc()) {
            echo '<div class="feedback-card">';
            echo '<div class="feedback-header">';
            echo '<span class="feedback-company">編號：' . $row['com_id'] . '</span>';
            echo '<span class="feedback-date">' . $row['date'] . '</span>';
            echo '</div>';
            echo '<div class="feedback-content">';
            echo '<p class="feedback-member">會員號碼：' . $row['membership_number'] . '</p>';
            echo '<p class="feedback-name">姓名：' . $row['name'] . '</p>';
            echo '<p class="feedback-text">1.操作此app時，有需要改進的問題嗎?：<br>' . $row['content1'] . '</p>';
            echo '<p class="feedback-text">2.需要新增什麼功能嗎?：<br>' . $row['content2'] . '</p>';
            echo '</div>';
            echo '</div>';
        }
      ?>
  </div>


  <!-- 常見問題與答案部分 -->
  <h1 class="bic">常見問題與答案<a class="add-qa-button">新增Q&A</a></h1>

  <!-- 修改您的 PHP 循环以存储 QA_id 值 -->
  <div class="accordion">
    <?php
      while ($row = $result_questions->fetch_assoc()) {
        echo '<div class="accordion-item" data-qa-id="' . $row['QA_id'] . '">';
        echo '<button class="accordion-button">' . $row['question'] . '</button>';
        echo '<div class="accordion-content">';
        echo "<p>" . $row['answer'] . "</p>";
        echo "<p>創建時間：" . $row['created_at'] . "</p>";
        echo "<p>更新時間：" . $row['updated_at'] . "</p>";
        echo '<div class="edit-buttons">';
        echo '<button class="edit-button">修改</button>';
        echo '<button class="cancel-button delete-button">刪除</button>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
      }
    ?>
  </div>


  </div>
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
  <script>

    // 在导向的页面中获取传递的登录状态
    const username = document.querySelector('a#portfolio-link').getAttribute('data-username');


      // 添加JavaScript以处理折叠面板的交互
      const buttons = document.querySelectorAll(".accordion-button");

      buttons.forEach((button) => {
        button.addEventListener("click", () => {
          const item = button.parentElement;
          item.classList.toggle("active");
        });
      });

      // 滚动到页面底部
      document.getElementById('scroll-to-top').addEventListener('click', function() {
        window.scrollTo(0, document.body.scrollHeight);
      });

      // 滚动到页面顶部
      document.getElementById('add-product').addEventListener('click', function() {
        window.scrollTo(0, 0);
      });

      // 新增Q&A
      document.querySelector('.add-qa-button').addEventListener('click', function() {
        // 显示弹出窗口和遮罩
        document.getElementById('custom-question').style.display = 'block';
        document.getElementById('overlay').style.display = 'block';
      });

      document.getElementById('cancelc-button').addEventListener('click', function() {
        // 隐藏弹出窗口和遮罩
        document.getElementById('custom-question').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
      });

      document.getElementById('confirm-button').addEventListener('click', function() {
        const questionInput = document.querySelector('#custom-question textarea[name="custom-question"]').value;
        const answerInput = document.querySelector('#custom-question textarea[name="custom-answer"]').value;

        if (!questionInput.trim() || !answerInput.trim()) {
          // 显示错误提示，输入不能为空
          Swal.fire({
            icon: 'error',
            title: '錯誤',
            text: '尚未輸入問題或回答',
          });
        } else {
          // 在问题和答案前面添加"Q："和"A："
          const formattedQuestion = "Q：" + questionInput;
          const formattedAnswer = "A：" + answerInput;

          // 执行AJAX请求将问题和答案插入到数据库
          const xhr = new XMLHttpRequest();
          xhr.open('POST', 'insert_question.php', true);
          xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
          xhr.onload = function() {
            if (xhr.status === 200) {
              // 显示成功提示
              Swal.fire({
                icon: 'success',
                title: '成功',
                text: '新增Q&A成功',
              }).then(() => {
                location.reload(); // 刷新页面
              });
              // 隐藏弹出窗口和遮罩
              document.getElementById('custom-question').style.display = 'none';
              document.getElementById('overlay').style.display = 'none';
            } else {
              // 显示错误提示
              Swal.fire({
                icon: 'error',
                title: '錯誤',
                text: '新增Q&A失败',
              });
            }
          };
          const data = 'question=' + formattedQuestion + '&answer=' + formattedAnswer;
          xhr.send(data);
        }
      });

      // 找到所有编辑按钮
      const editButtons = document.querySelectorAll(".edit-button");

      // 找到编辑窗口元素
      const editPopup = document.getElementById('edit-product-popup');

      // 找到编辑窗口内的元素
      const editQuestionField = document.querySelector('#edit-product-question');
      const editAnswerField = document.querySelector('#edit-product-answer');
      const editProductConfirmButton = document.getElementById('edit-product-confirm-button');
      const editProductCancelButton = document.getElementById('edit-product-cancel-button');
      const editProductIdField = document.querySelector('#edit-product-questioname'); // 新增這行

      // 为每个编辑按钮添加点击事件
      editButtons.forEach((button) => {
        button.addEventListener("click", () => {
          // 获取相关数据
          const accordionItem = button.closest('.accordion-item');
          const question = accordionItem.querySelector('.accordion-button').textContent;
          const answer = accordionItem.querySelector('.accordion-content p').textContent;
          const qaId = accordionItem.getAttribute('data-qa-id');

          // 将数据填充到编辑窗口
          editQuestionField.value = question;
          editAnswerField.value = answer;
          editProductIdField.value = qaId; // 填充問題編號

          // 显示编辑窗口
          editPopup.style.display = 'block';
          document.getElementById('overlay').style.display = 'block';

          // 添加编辑确认按钮的点击事件，可以在这里发送更新请求到服务器
          editProductConfirmButton.addEventListener('click', () => {
            // 执行更新操作，发送到服务器的代码可以在这里添加
            // 您需要使用 AJAX 请求将数据发送到服务器，更新数据库中的问题和答案

            // 更新后关闭编辑窗口
            editPopup.style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
          });
        });
      });

      // 点击取消按钮后关闭编辑窗口
      editProductCancelButton.addEventListener('click', () => {
        editPopup.style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
      });


      // 在“修改”按钮点击时执行
      document.getElementById('edit-product-confirm-button').addEventListener('click', function() {
          const qaId = document.getElementById('edit-product-questioname').value; // 获取QA_id
          const question = document.getElementById('edit-product-question').value; // 获取问题
          const answer = document.getElementById('edit-product-answer').value; // 获取答案

          // 发送AJAX请求到服务器以更新问题与答案
          $.ajax({
              type: "POST",
              url: "update_question.php", // 创建用于更新的PHP文件
              data: { QA_id: qaId, question: question, answer: answer },
              success: function(response) {
                  if (response === 'success') {
                      // 成功更新后，显示成功提示
                      Swal.fire({
                          icon: 'success',
                          title: '成功',
                          text: 'Q&A修改成功',
                      }).then(() => {
                          location.reload(); // 刷新页面
                      });
                  } else {
                      // 失败时显示错误提示
                      Swal.fire({
                          icon: 'error',
                          title: '錯誤',
                          text: 'Q&A修改失败',
                      });
                  }
              }
          });
      });

      // 找到所有删除按钮
      const deleteButtons = document.querySelectorAll(".delete-button");

      // 为每个删除按钮添加点击事件
      deleteButtons.forEach((button) => {
          button.addEventListener("click", () => {
              // 获取相关数据
              const qaId = button.closest('.accordion-item').getAttribute('data-qa-id');
              const question = button.closest('.accordion-item').querySelector('.accordion-button').textContent;

              // 弹出 SweetAlert2 确认对话框
              Swal.fire({
                  title: "確定刪除 " + question + " 問答嗎？",
                  text: "刪除後無法恢復。",
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonText: "確定",
                  cancelButtonText: "取消",
              }).then((result) => {
                  if (result.isConfirmed) {
                      // 执行 AJAX 请求将数据从数据库中删除
                      const xhr = new XMLHttpRequest();
                      xhr.open("POST", "delete_question.php", true);
                      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                      xhr.onload = function () {
                          if (xhr.status === 200 && xhr.responseText === "success") {
                              // 显示成功提示
                              Swal.fire("Q&A刪除成功", "", "success").then(() => {
                                  location.reload(); // 刷新页面
                              });
                          } else {
                              // 显示错误提示
                              Swal.fire("刪除失败", "", "error");
                          }
                      };
                      const data = "qaId=" + qaId;
                      xhr.send(data);
                  }
              });
          });
      });


  </script>

</body>
</html>