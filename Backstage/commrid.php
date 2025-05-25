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
    <link rel="stylesheet" href="assets/css/commrid.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
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
                    <li><a href="commrid.php" id="porrid-link"><span class="icon solid fa-truck" style="color: #000;">庫存管理</span></a></li>
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

    <div id="advanced-search" class="scroll-to-top-3">
        <i class="fas fa-search-plus"></i>
    </div>
    <!-- 搜尋 -->
    <!-- 遮罩 -->
    <div id="overlay" class="overlay"></div>

    <!-- 彈出視窗 -->
    <div id="advanced-search-popup" class="popuple">
        <div class="popup-content">

            <!-- 品項輸入框 -->
            <div class="action-row">
                <label for="Items">品項：</label>
                <input type="text" id="Items" name="Items">
            </div>

            <!-- 操作按鈕 -->
            <div class="action-buttons">
                <button id="advanced-search-confirm-button">確定</button>
                <button id="advanced-search-cancel-button">取消</button>
            </div>
        </div>
    </div>

    <!-- 搜尋 -->

    <!-- 進貨數量輸入彈出視窗 -->
    <div id="restock-popup" class="popuple" style="display:none;">
        <div class="popup-content">
            <!-- 品項顯示框（readonly，不可修改）-->
            <div class="action-row">
                <label for="restock-items">品項：</label>
                <input type="text" id="restock-items" name="restock-items" readonly>
            </div>

            <!-- 進貨數量輸入框 -->
            <div class="action-row">
                <label for="restock-amount">進貨數量：</label>
                <input type="number" id="restock-amount" name="restock-amount" min="1">
            </div>

            <!-- 操作按鈕 -->
            <div class="action-buttons">
                <button id="restock-confirm-button">確定</button>
                <button id="restock-cancel-button">取消</button>
            </div>
        </div>
    </div>

    <!-- 報銷數量輸入彈出視窗 -->
    <div id="write-off-popup" class="popuple" style="display:none;">
        <div class="popup-content">
            <!-- 品項顯示框（readonly，不可修改）-->
            <div class="action-row">
                <label for="write-off-items">品項：</label>
                <input type="text" id="write-off-items" name="write-off-items" readonly>
            </div>

            <!-- 報銷數量輸入框 -->
            <div class="action-row">
                <label for="write-off-amount">報銷數量：</label>
                <input type="number" id="write-off-amount" name="write-off-amount" min="1">
            </div>

            <!-- 操作按鈕 -->
            <div class="action-buttons">
                <button id="write-off-confirm-button">確定</button>
                <button id="write-off-cancel-button">取消</button>
            </div>
        </div>
    </div>


    <div id="main">
        <?php
        include("db_connection.php");

        if ($conn->connect_error) {
            die("連線失敗: " . $conn->connect_error);
        }

        // 查詢 ingredient 資料表
        $sql = "SELECT * FROM ingredient ORDER BY current_stock ASC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="card">';
                echo '<h3>' . htmlspecialchars($row["Ingredient_name"]) . '</h3>';
                echo '<p>單位：' . htmlspecialchars($row["unit"]) . '</p>';
                echo '<p>目前庫存：' . htmlspecialchars($row["current_stock"]) . '</p>';
                // 每個商品卡片中的 "進貨" 按鈕，並將食材名稱與ID作為 data- 屬性傳遞
                echo '<button class="restock-btn" data-id="' . $row["Ingredient_ID"] . '" data-name="' . htmlspecialchars($row["Ingredient_name"]) . '">進貨</button>';
                // "報銷" 按鈕
                echo '<button class="write-off-btn" data-id="' . $row["Ingredient_ID"] . '" data-name="' . htmlspecialchars($row["Ingredient_name"]) . '">報銷</button>';

                echo '</div>';
            }
        } else {
            echo "查無食材資料";
        }

        $conn->close();
        ?>
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
        // 取得相關元素
        const advancedSearchBtn = document.getElementById('advanced-search');
        const overlay = document.getElementById('overlay');
        const popup = document.getElementById('advanced-search-popup');
        const cancelBtn = document.getElementById('advanced-search-cancel-button');
        const confirmBtn = document.getElementById('advanced-search-confirm-button');

        // 顯示彈出視窗與遮罩
        advancedSearchBtn.addEventListener('click', function() {
            overlay.style.display = 'block';
            popup.style.display = 'block';
        });

        // 點擊取消按鈕，隱藏視窗與遮罩
        cancelBtn.addEventListener('click', function() {
            overlay.style.display = 'none';
            popup.style.display = 'none';
        });

        // 點擊遮罩，隱藏視窗與遮罩
        overlay.addEventListener('click', function() {
            overlay.style.display = 'none';
            popup.style.display = 'none';
        });

        // 確認按鈕（此處可以處理確認邏輯）
        confirmBtn.addEventListener('click', function() {
            const itemValue = document.getElementById('Items').value;
            console.log('已選擇品項:', itemValue); // 你可以將這裡替換為需要的處理邏輯
            overlay.style.display = 'none';
            popup.style.display = 'none';
        });


        //"進貨" restock.php
        document.querySelectorAll('.restock-btn').forEach(button => {
            button.addEventListener('click', function() {
                const ingredientId = this.getAttribute('data-id');
                const ingredientName = this.getAttribute('data-name');

                // 顯示進貨視窗並預填品項名稱
                document.getElementById('restock-items').value = ingredientName;
                document.getElementById('restock-popup').style.display = 'block';

                // 監聽確定按鈕
                document.getElementById('restock-confirm-button').onclick = function() {
                    const amount = document.getElementById('restock-amount').value;
                    if (amount && !isNaN(amount) && parseInt(amount) > 0) {
                        // 發送 AJAX 請求來更新庫存
                        const xhr = new XMLHttpRequest();
                        xhr.open("POST", "restock.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                const response = JSON.parse(xhr.responseText); // 解析回應的 JSON

                                // 根據回應顯示 SweetAlert2 視窗
                                if (response.status === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: '庫存更新成功!',
                                        text: '庫存數量已成功更新。',
                                    }).then(() => {
                                        location.reload(); // 頁面重新載入，顯示最新庫存
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: '庫存更新失敗!',
                                        text: response.message || '請稍後再試。',
                                    });
                                }
                            }
                        };
                        xhr.send("id=" + ingredientId + "&amount=" + amount);
                        document.getElementById('restock-popup').style.display = 'none'; // 關閉視窗
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: '無效的數量',
                            text: '請輸入有效的數量。',
                        });
                    }
                };

                // 監聽取消按鈕，隱藏視窗
                document.getElementById('restock-cancel-button').onclick = function() {
                    document.getElementById('restock-popup').style.display = 'none';
                };
            });
        });

        //報銷

// "報銷" writeOff.php
document.querySelectorAll('.write-off-btn').forEach(button => {
    button.addEventListener('click', function() {
        const ingredientId = this.getAttribute('data-id');
        const ingredientName = this.getAttribute('data-name');

        // 顯示報銷視窗並預填品項名稱
        document.getElementById('write-off-items').value = ingredientName;
        document.getElementById('write-off-popup').style.display = 'block';

        // 監聽確定按鈕
        document.getElementById('write-off-confirm-button').onclick = function() {
            const amount = document.getElementById('write-off-amount').value;
            if (amount && !isNaN(amount) && parseInt(amount) > 0) {
                // 發送 AJAX 請求來更新庫存（減少庫存數量）
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "writeOff.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText); // 解析回應的 JSON

                        // 根據回應顯示 SweetAlert2 視窗
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: '報銷成功!',
                                text: '報銷數量已成功更新。',
                            }).then(() => {
                                location.reload(); // 頁面重新載入，顯示最新庫存
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: '報銷失敗!',
                                text: response.message || '請稍後再試。',
                            });
                        }
                    }
                };
                xhr.send("id=" + ingredientId + "&amount=" + amount);
                document.getElementById('write-off-popup').style.display = 'none'; // 關閉視窗
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: '無效的數量',
                    text: '請輸入有效的數量。',
                });
            }
        };

        // 監聽取消按鈕，隱藏視窗
        document.getElementById('write-off-cancel-button').onclick = function() {
            document.getElementById('write-off-popup').style.display = 'none';
        };
    });
});


    </script>

</body>

</html>