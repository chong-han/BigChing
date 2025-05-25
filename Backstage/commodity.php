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
    <link rel="stylesheet" href="assets/css/commoditysss.css" />
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
                    <li><a href="commodity.php" id="portfolio-link"><span class="icon solid fa-shopping-bag" style="color: #000;">商品管理</span></a></li>
                    <li><a href="commrid.php" id="porrid-link" data-username="<?php echo $_SESSION['username']; ?>"><span class="icon solid fa-truck">庫存管理</span></a></li>
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

    <div id="scroll-to-top" class="scroll-to-top">
        <i class="fas fa-chevron-up"></i>
    </div>
    <div id="add-product" class="scroll-to-top-2">
        <i class="fas fa-plus-circle"></i>
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

                <!-- 類別輸入框 -->
                <div class="action-row">
                    <label for="category">類別：</label>
                    <select id="category" name="category">
                        <option value="">-- 請選擇類別 --</option>
                        <option value="火鍋類">火鍋類</option>
                        <option value="主食麵類">主食麵類</option>
                        <option value="蔬菜類">蔬菜類</option>
                        <option value="香菇類">香菇類</option>
                        <option value="火鍋料類">火鍋料類</option>
                        <option value="其他類">其他類</option>
                        <option value="豆品類">豆品類</option>
                        <option value="上等肉類">上等肉類</option>
                        <option value="冬季蔬菜類">冬季蔬菜類</option>
                    </select>
                </div>

                <!-- 售價輸入框 -->
                <div class="action-row">
                    <label for="price">售價：</label>
                    <input type="text" id="price" name="price">
                </div>

                <!-- 是否供應選項 -->
                <div class="action-row">
                    <label>是否供應：</label>
                    <div class="checkbox-group">
                        <input type="checkbox" id="available" name="is_available" value="1">
                        <label for="available">供應中</label>
                        
                        <input type="checkbox" id="unavailable" name="is_available" value="0">
                        <label for="unavailable">暫停供應</label>
                    </div>
                </div>


                <!-- 操作按鈕 -->
                <div class="action-buttons">
                    <button id="advanced-search-confirm-button">確定</button>
                    <button id="advanced-search-cancel-button">取消</button>
                </div>
            </div>
        </div>
    <!-- 搜尋 -->

    <!-- 新增商品視窗 -->
        <div id="add-item-popup" class="popuple" style="display:none;">
        <div class="popup-content">
            <h3>選擇新增類型</h3>
            <div class="action-buttons">
            <!-- 兩個新增按鈕 -->
            <button id="add-hotpot-button">新增火鍋</button>
            <button id="add-product-button">新增產品</button>
            </div>
        </div>
        </div>

    <!-- 新增產品視窗 -->
        <div id="add-product-detail-popup" class="popuple" style="display:none;">
        <div class="popup-content">
            <h3>新增產品</h3>

            <!-- 品項輸入框 -->
            <div class="action-row">
            <label for="add-product-name">品項：</label>
            <input type="text" id="add-product-name" name="add-product-name">
            </div>

            <!-- 類別輸入框 -->
            <div class="action-row">
            <label for="add-product-category">類別：</label>
            <select id="add-product-category" name="add-product-category">
                <option value="">-- 請選擇類別 --</option>
                <option value="主食麵類">主食麵類</option>
                <option value="蔬菜類">蔬菜類</option>
                <option value="香菇類">香菇類</option>
                <option value="火鍋料類">火鍋料類</option>
                <option value="其他類">其他類</option>
                <option value="豆品類">豆品類</option>
                <option value="上等肉類">上等肉類</option>
                <option value="冬季蔬菜類">冬季蔬菜類</option>
            </select>
            </div>

            <!-- 售價輸入框 -->
            <div class="action-row">
            <label for="add-product-price">售價：</label>
            <input type="text" id="add-product-price" name="add-product-price">
            </div>

            <!-- 操作按鈕 -->
            <div class="action-buttons">
            <button id="add-product-confirm-button">新增產品</button>
            <button id="add-product-cancel-button">取消</button>
            </div>
        </div>
        </div>

    <!-- 修改彈出視窗 -->
        <div id="edit-popup" class="popuple">
            <div class="popup-content">

                <!-- 品項輸入框 -->
                <div class="action-row">
                    <label for="edit-Items">品項：</label>
                    <input type="text" id="edit-Items" name="edit-Items">
                </div>

                <!-- 類別輸入框 -->
                <div class="action-row">
                    <label for="edit-category">類別：</label>
                    <select id="edit-category" name="edit-category">
                        <option value="">-- 請選擇類別 --</option>
                        <option value="主食麵類">主食麵類</option>
                        <option value="蔬菜類">蔬菜類</option>
                        <option value="香菇類">香菇類</option>
                        <option value="火鍋料類">火鍋料類</option>
                        <option value="其他類">其他類</option>
                        <option value="豆品類">豆品類</option>
                        <option value="上等肉類">上等肉類</option>
                        <option value="冬季蔬菜類">冬季蔬菜類</option>
                    </select>
                </div>

                <!-- 售價輸入框 -->
                <div class="action-row">
                    <label for="edit-price">售價：</label>
                    <input type="text" id="edit-price" name="edit-price">
                </div>

                <!-- 操作按鈕 -->
                <div class="action-buttons">
                    <button id="edit-confirm-button">修改</button>
                    <button id="edit-cancel-button">取消</button>
                </div>
            </div>
        </div>
    <!-- 火鍋類商品修改彈窗 -->

        <div id="hotpot-edit-popup" class="popuple" style="display:none;">
        <div class="popup-content">

            <div class="action-row">
            <label for="hotpot-edit-name">品項：</label>
            <input type="text" id="hotpot-edit-name" name="hotpot-edit-name" />
            </div>

            <!-- 刪除類別欄位 -->

            <div class="action-row">
            <label for="hotpot-edit-price">價格：</label>
            <input type="text" id="hotpot-edit-price" name="hotpot-edit-price" />
            </div>

            <!-- 火鍋用料表格，保持不變 -->
            <div class="action-row">
            <label>用料與數量：</label>
            <table id="ingredients-table" class="ingredient-table">
                <thead>
                <tr>
                    <th>用料名稱</th>
                    <th>數量</th>
                </tr>
                </thead>
                <tbody>
                <!-- JS 動態生成 -->
                </tbody>
            </table>
            </div>

            <div class="action-buttons">
            <button id="hotpot-edit-confirm-button">修改</button>
            <button id="hotpot-edit-cancel-button">取消</button>
            </div>

        </div>
        </div>

    <?php
        include("db_connection.php");

        if ($conn->connect_error) {
            die("連線失敗: " . $conn->connect_error);
        }
        $ings = [];
        $res = $conn->query("SELECT Ingredient_ID, Ingredient_name FROM ingredient");
        while ($r = $res->fetch_assoc()) {
            $ings[] = $r;
        }
        // 輸出 JSON 變數到前端
        echo "<script>window.ingredientOptions = " . json_encode($ings, JSON_UNESCAPED_UNICODE) . ";</script>";
    ?>

    <!-- 新增火鍋視窗 -->
        <div id="add-hotpot-popup" class="popuple" style="display:none;">
            <div class="popup-content">
                <h3>新增火鍋</h3>

                <div class="action-row">
                <label for="add-hotpot-name">品項：</label>
                <input type="text" id="add-hotpot-name" name="add-hotpot-name" />
                </div>

                <div class="action-row">
                <label for="add-hotpot-price">價格：</label>
                <input type="text" id="add-hotpot-price" name="add-hotpot-price" />
                </div>

                <!-- 火鍋用料表格 -->
                <div class="action-row">
                <label>用料與數量：</label>
                <table id="add-ingredients-table" class="ingredient-table">
                    <thead>
                        <tr><th>用料名稱</th><th>數量</th><th>操作</th></tr>
                    </thead>
                    <tbody>
                        <button type="button" id="add-ingredient-row-button" class="action-button">加入品項</button>
                    </tbody>
                </table>           
                </div>
    
                <div class="action-buttons">
                <button id="add-hotpot-confirm-button">新增火鍋</button>
                <button id="add-hotpot-cancel-button">取消</button>
                </div>
            </div>
        </div>

    <div id="main">
        <?php

        include("db_connection.php");

        if ($conn->connect_error) {
            die("連線失敗: " . $conn->connect_error);
        }

        // 查詢 menu 資料表
        $sql = "SELECT * FROM menu";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // 基本卡片資料
                echo '<div class="card">';
                echo '<h3>' . htmlspecialchars($row["Menu_name"]) . '</h3>';
                echo '<p>價格：' . htmlspecialchars($row["sell_price"]) . ' 元</p>';
                echo '<p class="category-label">分類：' . htmlspecialchars($row["category"]) . '</p>';

                // 預設用料陣列空白
                $ingredientsJSON = "[]";

                if ($row["category"] === "火鍋類") {
                    // 取 HotPot_ID
                    $getHotpotIDSQL = "SELECT p.HotPot_ID FROM product p JOIN menu m ON m.Product_ID = p.Product_ID WHERE m.Menu_name = ?";
                    $stmtHotpot = $conn->prepare($getHotpotIDSQL);
                    $stmtHotpot->bind_param("s", $row["Menu_name"]);
                    $stmtHotpot->execute();
                    $resHotpot = $stmtHotpot->get_result();

                    if ($resHotpot->num_rows > 0) {
                        $hotpotID = $resHotpot->fetch_assoc()["HotPot_ID"];

                        $sqlIngredients = "SELECT i.Ingredient_ID, i.Ingredient_name, h.quantity
                                        FROM hotpot h
                                        JOIN ingredient i ON h.Ingredient_ID = i.Ingredient_ID
                                        WHERE h.HotPot_ID = ?";
                        $stmtIng = $conn->prepare($sqlIngredients);
                        $stmtIng->bind_param("i", $hotpotID);
                        $stmtIng->execute();
                        $resIng = $stmtIng->get_result();

                        $ingredientsArr = [];
                        while ($ingRow = $resIng->fetch_assoc()) {
                            $ingredientsArr[] = [
                                "Ingredient_ID" => $ingRow["Ingredient_ID"],
                                "Ingredient_name" => $ingRow["Ingredient_name"],
                                "quantity" => $ingRow["quantity"]
                            ];
                        }
                        $ingredientsJSON = htmlspecialchars(json_encode($ingredientsArr), ENT_QUOTES);
                    }
                }

                // availability 顯示
                echo '<p class="availability ' . ($row["is_available"] ? 'available' : '') . '">' . ($row["is_available"] ? '供應中' : '暫停供應') . '</p>';

                // 修改按鈕，帶入完整資料（包括用料 JSON）
                echo '<div class="card-actions">';
                echo '<button class="edit-button" '.
                    'data-menu-id="' . htmlspecialchars($row["Menu_ID"]) . '" '.
                    'data-name="' . htmlspecialchars($row["Menu_name"]) . '" '.
                    'data-category="' . htmlspecialchars($row["category"]) . '" '.
                    'data-price="' . htmlspecialchars($row["sell_price"]) . '" '.
                    'data-available="' . htmlspecialchars($row["is_available"]) . '" '.
                    'data-ingredients=\'' . $ingredientsJSON . '\'>修改</button>';
                           // 刪除按鈕
                    // 這是您渲染每個商品卡片的代碼的一部分
                    echo '<button class="delete-button" data-menu-id="' . htmlspecialchars($row["Menu_ID"]) . '" data-category="' . htmlspecialchars($row["category"]) . '">刪除</button>';

                echo '</div>';

                echo '</div>';
            }


        } else {
            echo "查無商品資料";
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

    $(document).ready(function () {
        // 當點擊圖示時執行滾動到頂部的動作
        $("#scroll-to-top").click(function () {
            $("html, body").animate({ scrollTop: 0 }, "slow");
        });
    });

    // 搜尋視窗(顯示)
        document.addEventListener("DOMContentLoaded", function () {
            const advancedSearchButton = document.getElementById("advanced-search");
            const advancedSearchPopup = document.getElementById("advanced-search-popup");
            const advancedSearchCancelButton = document.getElementById("advanced-search-cancel-button");
            const overlay = document.getElementById("overlay");

            // 顯示視窗
            advancedSearchButton.addEventListener("click", function () {
                overlay.style.display = "block";
                advancedSearchPopup.style.display = "block";
            });

            // 隱藏視窗
            advancedSearchCancelButton.addEventListener("click", function () {
                overlay.style.display = "none";
                advancedSearchPopup.style.display = "none";
            });

            // 點擊遮罩也關閉
            overlay.addEventListener("click", function () {
                overlay.style.display = "none";
                advancedSearchPopup.style.display = "none";
            });
        });
    // 搜尋視窗

    // 搜尋功能已完成

        document.addEventListener("DOMContentLoaded", function () {
        const advancedSearchButton = document.getElementById("advanced-search-confirm-button");
        const overlay = document.getElementById("overlay");
        const popup = document.getElementById("advanced-search-popup");

        advancedSearchButton.addEventListener("click", function () {
            const itemValue = document.getElementById("Items").value.trim().toLowerCase();
            const categoryValue = document.getElementById("category").value.trim().toLowerCase();
            const priceValue = document.getElementById("price").value.trim().toLowerCase();

            // 多選供應狀態處理
            const availabilityChecks = document.querySelectorAll('input[name="is_available"]:checked');
            const availabilityValues = Array.from(availabilityChecks).map(cb => cb.value === "1" ? "供應中" : "暫停供應");

            const productCards = document.querySelectorAll(".card");
            let matchCount = 0;

            productCards.forEach(function (card) {
            const name = card.querySelector("h3").textContent.trim().toLowerCase();
            const price = card.querySelector("p:nth-of-type(1)").textContent.trim().toLowerCase();
            const category = card.querySelector("p:nth-of-type(2)").textContent.trim().toLowerCase();
            const status = card.querySelector("p:nth-of-type(3)").textContent.trim(); // status 不轉小寫以符合 "供應中"/"暫停供應"

            let isMatch = true;

            if (itemValue && !name.includes(itemValue)) isMatch = false;
            if (categoryValue && !category.includes(categoryValue)) isMatch = false;
            if (priceValue && !price.includes(priceValue)) isMatch = false;
            if (availabilityValues.length > 0 && !availabilityValues.includes(status)) isMatch = false;

            if (isMatch) {
                card.classList.remove("hidden");
                card.classList.add("visible");
                matchCount++;
            } else {
                card.classList.remove("visible");
                card.classList.add("hidden");
            }
            });

            if (matchCount === 0) {
            Swal.fire({
                icon: "error",
                title: "錯誤",
                text: "查無此項商品，將顯示所有品項。",
            });

            productCards.forEach(function (card) {
                card.classList.remove("hidden");
                card.classList.add("visible");
            });
            }

            overlay.style.display = "none";
            popup.style.display = "none";
        });
        });

    // 搜尋功能

    // 火鍋品項新增
        document.addEventListener("DOMContentLoaded", function(){
        const addRowBtn = document.getElementById("add-ingredient-row-button");
        const tbody    = document.querySelector("#add-ingredients-table tbody");

        addRowBtn.addEventListener("click", function(){
            // 建立一個 <tr>
            const tr = document.createElement("tr");

            // 用料 <select>
            const tdSelect = document.createElement("td");
            const sel = document.createElement("select");
            sel.name = "ingredients[]"; // 後端接收陣列
            window.ingredientOptions.forEach(opt => {
            const o = document.createElement("option");
            o.value = opt.Ingredient_ID;
            o.textContent = opt.Ingredient_name;
            sel.appendChild(o);
            });
            tdSelect.appendChild(sel);
            tr.appendChild(tdSelect);

            // 數量 <input>
            const tdQty = document.createElement("td");
            const inp = document.createElement("input");
            inp.type = "number";
            inp.name = "quantities[]"; // 與上面對應
            inp.min = "1";
            inp.value = "1";
            tdQty.appendChild(inp);
            tr.appendChild(tdQty);

            // 刪除按鈕
            const tdDel = document.createElement("td");
            const delBtn = document.createElement("button");
            delBtn.type = "button";
            delBtn.textContent = "移除";
            delBtn.addEventListener("click", () => tr.remove());
            tdDel.appendChild(delBtn);
            tr.appendChild(tdDel);

            // 插入到表格
            tbody.appendChild(tr);
        });
        });

    // 新增商品已完成
        document.addEventListener("DOMContentLoaded", function () {
        // 主要按鈕與彈窗
        const addItemButton           = document.getElementById("add-product");                   // 觸發「新增商品」的按鈕
        const addItemPopup            = document.getElementById("add-item-popup");                // 「新增商品」選擇類型視窗
        const addProductDetailPopup   = document.getElementById("add-product-detail-popup");     // 「新增產品」詳細視窗
        const addHotpotPopup          = document.getElementById("add-hotpot-popup");              // 「新增火鍋」詳細視窗
        const overlay                 = document.getElementById("overlay");                       // 共用遮罩

        // 「新增商品」視窗內的按鈕
        const triggerAddHotpotBtn     = document.getElementById("add-hotpot-button");             // 選擇「新增火鍋」
        const triggerAddProductBtn    = document.getElementById("add-product-button");            // 選擇「新增產品」

        // 「新增產品」視窗的按鈕
        // const addProductConfirmBtn    = document.getElementById("add-product-confirm-button");    // 確認新增產品
        const addProductCancelBtn     = document.getElementById("add-product-cancel-button");     // 取消新增產品

        // 「新增火鍋」視窗的按鈕
        // const addHotpotConfirmBtn     = document.getElementById("add-hotpot-confirm-button");     // 確認新增火鍋
        const addHotpotCancelBtn      = document.getElementById("add-hotpot-cancel-button");      // 取消新增火鍋

        // 開啟「新增商品」選擇視窗
        addItemButton.addEventListener("click", () => {
            addItemPopup.style.display = "block";
            overlay.style.display     = "block";
        });

        // 「新增商品」視窗 → 點「新增火鍋」
        triggerAddHotpotBtn.addEventListener("click", () => {
            addItemPopup.style.display  = "none";
            addHotpotPopup.style.display = "block";
        });

        // 「新增商品」視窗 → 點「新增產品」
        triggerAddProductBtn.addEventListener("click", () => {
            addItemPopup.style.display         = "none";
            addProductDetailPopup.style.display = "block";
        });

        // 新增產品確認
        // addProductConfirmBtn.addEventListener("click", () => {
        //     // TODO: 將 #add-product-name、#add-product-category、#add-product-price 等值送後端
        //     alert("新增產品成功！");
        //     addProductDetailPopup.style.display = "none";
        //     overlay.style.display               = "none";
        // });

        // 取消新增產品
        addProductCancelBtn.addEventListener("click", () => {
            addProductDetailPopup.style.display = "none";
            overlay.style.display               = "none";
        });

        // 新增火鍋確認
        // addHotpotConfirmBtn.addEventListener("click", () => {
        //     // TODO: 將 #add-hotpot-name、#add-hotpot-price、#add-ingredients-table 等值送後端
        //     alert("新增火鍋成功！");
        //     addHotpotPopup.style.display = "none";
        //     overlay.style.display        = "none";
        // });

        // 取消新增火鍋
        addHotpotCancelBtn.addEventListener("click", () => {
            addHotpotPopup.style.display = "none";
            overlay.style.display        = "none";
        });

        // 點遮罩時，關閉所有彈窗
        overlay.addEventListener("click", () => {
            addItemPopup.style.display           = "none";
            addProductDetailPopup.style.display  = "none";
            addHotpotPopup.style.display         = "none";
            overlay.style.display                = "none";
        });
        });

    // 新增產品add_menu_and_ingredient.php
        document.getElementById("add-product-confirm-button")
        .addEventListener("click", async function () {
            const name     = document.getElementById("add-product-name").value.trim();
            const category = document.getElementById("add-product-category").value;
            const price    = document.getElementById("add-product-price").value.trim();

            if (!name || !category || !price) {
            return alert("請填寫所有欄位！");
            }

            try {
            const resp = await fetch("add_menu_and_ingredient.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ name, category, price })
            });
            const data = await resp.json();
            if (data.success) {
                alert("新增成功！");
                // 隱藏彈窗
                document.getElementById("add-product-detail-popup").style.display = "none";
                document.getElementById("overlay").style.display = "none";
                // （可選）重新載入或動態加入一張新卡片到 .card 容器
                location.reload();
            } else {
                alert("新增失敗：" + data.message);
            }
            } catch (err) {
            console.error(err);
            alert("請檢查網路或伺服器狀態");
            }
        });

    // 新增火鍋add_hotpot.php
        document.getElementById("add-hotpot-confirm-button").addEventListener("click", function(event) {
            // 抓取火鍋名稱和價格
            const hotpotName = document.getElementById("add-hotpot-name").value;
            const hotpotPrice = document.getElementById("add-hotpot-price").value;
            
            // 檢查火鍋名稱和價格是否為空
            if (!hotpotName.trim() || !hotpotPrice.trim()) {
                alert("請輸入品項名稱與價格！");
                return; // 防止表單提交
            }

            // 抓取用料和數量
            const ingredients = [];
            const quantities = [];
            const selectElements = document.querySelectorAll("#add-ingredients-table tbody tr");

            let isIngredientEmpty = true; // 用來檢查是否至少有一個用料

            selectElements.forEach(row => {
                const ingredientId = row.querySelector("select").value;
                const quantity = row.querySelector("input").value;

                // 檢查每一行的用料和數量
                if (ingredientId && quantity.trim()) {
                    ingredients.push(ingredientId);
                    quantities.push(quantity);
                    isIngredientEmpty = false; // 至少有一個用料
                }
            });

            // 如果沒有選擇用料，顯示警告
            if (isIngredientEmpty) {
                alert("請至少加入一個用料！");
                return; // 防止表單提交
            }

            // 創建 AJAX 請求來傳送資料給後端
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "add_hotpot.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            
            // 透過POST傳送資料
            xhr.send(`hotpotName=${hotpotName}&hotpotPrice=${hotpotPrice}&ingredients=${JSON.stringify(ingredients)}&quantities=${JSON.stringify(quantities)}`);
            
            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert("火鍋新增成功！");
                    location.reload();
                }
            };
        });


    // 狀態更改toggle_availability.php

        document.addEventListener("DOMContentLoaded", function () {
        // 監聽所有卡片的點擊事件
        document.querySelectorAll(".card").forEach(function (card) {
            card.addEventListener("click", function (e) {
            if (e.target.classList.contains("edit-button")) {
                return;
            }
            const itemName = card.querySelector("h3").textContent.trim();

            Swal.fire({
                title: itemName + " 更改供應狀態？",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "確認",
                cancelButtonText: "取消"
            }).then((result) => {
                if (result.isConfirmed) {
                // 發送 AJAX 請求到後端
                fetch("toggle_availability.php", {
                    method: "POST",
                    headers: {
                    "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ menu_name: itemName })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                    Swal.fire({
                        icon: "success",
                        title: "已更新",
                        text: itemName + " 的供應狀態已更新！"
                    }).then(() => {
                        location.reload(); // 重新整理頁面更新狀態
                    });
                    } else {
                    Swal.fire({
                        icon: "error",
                        title: "錯誤",
                        text: data.message || "更新失敗，請稍後再試"
                    });
                    }
                });
                }
            });
            });
        });
        });

    // 狀態更改   

    // 修改視窗(填入內容)

        document.addEventListener("DOMContentLoaded", function () {
        const editPopup = document.getElementById("edit-popup");
        const overlay = document.getElementById("overlay");

        const editNameInput = document.getElementById("edit-Items");
        const editCategorySelect = document.getElementById("edit-category");
        const editPriceInput = document.getElementById("edit-price");
        const editCancelButton = document.getElementById("edit-cancel-button");

        document.querySelectorAll(".edit-button").forEach(function (btn) {
            btn.addEventListener("click", function (e) {
            const menuId = this.getAttribute("data-menu-id");
            const name = this.getAttribute("data-name");
            const category = this.getAttribute("data-category");
            const price = this.getAttribute("data-price");

            // 排除火鍋類（可選，不排除的話請移除此條件）
            if (category === "火鍋類") return;

            // 填入值
            editNameInput.value = name;
            editCategorySelect.value = category;
            editPriceInput.value = price;

            // 顯示彈窗
            overlay.style.display = "block";
            editPopup.style.display = "block";

            // 可額外綁定 menuId 給確認按鈕
            document.getElementById("edit-confirm-button").setAttribute("data-menu-id", menuId);
            });
        });

        // 取消按鈕關閉彈窗
        editCancelButton.addEventListener("click", function () {
            overlay.style.display = "none";
            editPopup.style.display = "none";
        });

        // 點遮罩也關閉
        overlay.addEventListener("click", function () {
            overlay.style.display = "none";
            editPopup.style.display = "none";
        });
        });


    // 火鍋修改(填入當前該項商品內容)

        document.addEventListener("DOMContentLoaded", function () {
        const hotpotEditPopup = document.getElementById("hotpot-edit-popup");
        const overlay = document.getElementById("overlay");

        const nameInput = document.getElementById("hotpot-edit-name");
        // const categoryInput = document.getElementById("hotpot-edit-category"); // 移除此行
        const priceInput = document.getElementById("hotpot-edit-price");
        const ingredientsTableBody = document.querySelector("#ingredients-table tbody");

        const cancelBtn = document.getElementById("hotpot-edit-cancel-button");

        document.querySelectorAll(".edit-button").forEach(function (btn) {
            btn.addEventListener("click", function (e) {
            e.stopPropagation();

            const category = btn.getAttribute("data-category");

            if (category !== "火鍋類") return;

            const ingredientsJson = btn.getAttribute("data-ingredients");
            const ingredients = ingredientsJson ? JSON.parse(ingredientsJson) : [];

            // 填入基本資料
            nameInput.value = btn.getAttribute("data-name");
            // categoryInput.value = category;  // 刪除此行
            priceInput.value = btn.getAttribute("data-price");

            // 清空表格body
            ingredientsTableBody.innerHTML = "";

            // 動態產生用料欄位
            ingredients.forEach(function (ing) {
                const tr = document.createElement("tr");

                // 用料名稱（input）
                const tdName = document.createElement("td");
                const inputName = document.createElement("input");
                inputName.type = "text";
                inputName.value = ing.Ingredient_name;
                inputName.setAttribute("data-ingredient-id", ing.Ingredient_ID);
                tdName.appendChild(inputName);
                tr.appendChild(tdName);

                // 數量（input）
                const tdQty = document.createElement("td");
                const inputQty = document.createElement("input");
                inputQty.type = "number";
                inputQty.min = "0";
                inputQty.value = ing.quantity;
                tdQty.appendChild(inputQty);
                tr.appendChild(tdQty);

                ingredientsTableBody.appendChild(tr);
            });

            // 顯示彈窗
            overlay.style.display = "block";
            hotpotEditPopup.style.display = "block";
            });
        });

        cancelBtn.addEventListener("click", function () {
            overlay.style.display = "none";
            hotpotEditPopup.style.display = "none";
        });

        overlay.addEventListener("click", function () {
            overlay.style.display = "none";
            hotpotEditPopup.style.display = "none";
        });
        });

    // 刪除完成delete_hotpot.php跟delete_product.php

        document.addEventListener("DOMContentLoaded", function () {
            const deleteButtons = document.querySelectorAll(".delete-button");
            
            deleteButtons.forEach(function (button) {
                button.addEventListener("click", function (event) {
                    // 阻止事件冒泡，防止觸發其他不必要的事件
                    event.stopPropagation();

                    const menuID = this.getAttribute("data-menu-id");
                    const category = this.getAttribute("data-category");

                    // 使用 SweetAlert 顯示確認刪除窗格
                    Swal.fire({
                        title: '確認刪除?',
                        text: "您確定要刪除該商品嗎?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: '刪除',
                        cancelButtonText: '取消'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // 根據分類決定刪除的邏輯
                            if (category === "火鍋類") {
                                // 刪除火鍋類相關資料
                                fetch('delete_hotpot.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                    },
                                    body: JSON.stringify({
                                        menuID: menuID
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire('刪除成功!', '', 'success');
                                        location.reload();
                                    } else {
                                        Swal.fire('刪除失敗!', '', 'error');
                                    }
                                });
                            } else {
                                // 刪除非火鍋類相關資料
                                fetch('delete_product.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                    },
                                    body: JSON.stringify({
                                        menuID: menuID
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire('刪除成功!', '', 'success');
                                        location.reload();
                                    } else {
                                        Swal.fire('刪除失敗!', '', 'error');
                                    }
                                });
                            }
                        }
                    });
                });
            });
        });

    </script>

</body>
</html>
