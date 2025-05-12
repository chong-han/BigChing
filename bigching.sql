-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2025-05-12 17:36:12
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `bigching`
--

-- --------------------------------------------------------

--
-- 資料表結構 `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL COMMENT '顧客ID',
  `name` varchar(255) NOT NULL COMMENT '顧客姓名',
  `email` varchar(255) DEFAULT NULL COMMENT '電子郵件',
  `phone` varchar(20) DEFAULT NULL COMMENT '聯絡電話'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `customer`
--

INSERT INTO `customer` (`customer_id`, `name`, `email`, `phone`) VALUES
(1, '林小明', 'xiaoming.lin@example.com', '912345678'),
(2, '陳美麗', 'meili.chen@example.com', '923456789'),
(3, '王大志', 'dazhi.wang@example.com', '934567890'),
(4, '李小華', 'xiaohua.li@example.com', '945678901'),
(5, '張雅婷', 'yating.zhang@example.com', '956789012'),
(6, '吳宗憲', 'zongxian.wu@example.com', '967890123'),
(7, '周芷若', 'zhiruo.zhou@example.com', '978901234'),
(8, '徐小娟', 'xiaojuan.xu@example.com', '989012345'),
(9, '蔡宏仁', 'hongren.tsai@example.com', '990123456'),
(10, '林宜蓁', 'yichen.lin@example.com', '911222333');

-- --------------------------------------------------------

--
-- 資料表結構 `ingredient`
--

CREATE TABLE `ingredient` (
  `ingredient_id` int(11) NOT NULL COMMENT '原料ID',
  `name` varchar(255) NOT NULL COMMENT '原料名稱',
  `unit` varchar(50) DEFAULT NULL COMMENT '單位'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` int(11) NOT NULL COMMENT '庫存ID',
  `ingredient_id` int(11) DEFAULT NULL COMMENT '原料（外部鍵）',
  `quantity` int(11) NOT NULL COMMENT '目前數量',
  `safety_stock` int(11) DEFAULT NULL COMMENT '安全庫存'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `menu_item`
--

CREATE TABLE `menu_item` (
  `menu_id` int(11) NOT NULL COMMENT '菜單ID',
  `name` varchar(255) NOT NULL COMMENT '品項名稱',
  `price` int(11) NOT NULL COMMENT '價格',
  `category` varchar(100) DEFAULT NULL COMMENT '分類',
  `is_ingredient` tinyint(4) DEFAULT NULL COMMENT '是否為原料'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `menu_item`
--

INSERT INTO `menu_item` (`menu_id`, `name`, `price`, `category`, `is_ingredient`) VALUES
(1, '霸王海鮮鍋', 120, '火鍋類', 0),
(2, '死神辣辣麵', 150, '火鍋類', 0),
(3, '麻辣套餐', 150, '火鍋類', 0),
(4, '麻辣鴨血臭臭鍋', 120, '火鍋類', 0),
(5, '韓式泡菜臭臭鍋', 120, '火鍋類', 0),
(6, '大腸鴨血臭臭鍋', 120, '火鍋類', 0),
(7, '招牌鴨血臭臭鍋', 100, '火鍋類', 0),
(8, '韓國拉麵', 35, '主食麵類', 0),
(9, '蒸煮麵', 25, '主食麵類', 0),
(10, '媽媽拉麵', 20, '主食麵類', 0),
(11, '烏龍麵', 25, '主食麵類', 0),
(12, '王子麵', 15, '主食麵類', 0),
(13, '極品意麵', 20, '主食麵類', 0),
(14, '極品雞絲麵', 20, '主食麵類', 0),
(15, '統一脆麵', 20, '主食麵類', 0),
(16, '關廟麵', 20, '主食麵類', 0),
(17, '入味冬粉', 15, '主食麵類', 0),
(18, '入味河粉', 15, '主食麵類', 0),
(19, '無骨湯燒雞排', 35, '上等肉類', 0),
(20, '滷肉排', 35, '上等肉類', 0),
(21, '豬肉片', 30, '上等肉類', 0),
(22, '牛肉片', 30, '上等肉類', 0),
(23, '隔間肉', 40, '上等肉類', 0),
(24, '大腸', 40, '上等肉類', 0),
(25, '粉腸', 40, '上等肉類', 0),
(26, '豬頭皮', 30, '上等肉類', 0),
(27, '豬耳朵', 30, '上等肉類', 0),
(28, '豬舌頭', 30, '上等肉類', 0),
(29, '鴨胗', 20, '上等肉類', 0),
(30, '豬皮', 15, '上等肉類', 0),
(31, '鴨心', 20, '上等肉類', 0),
(32, '手工大黑豆干', 25, '豆品類', 0),
(33, '五香豆干', 15, '豆品類', 0),
(34, '手工蘭花干', 25, '豆品類', 0),
(35, '手工豆包', 10, '豆品類', 0),
(36, '手工百頁豆腐', 15, '豆品類', 0),
(37, '上等大油皮', 20, '豆品類', 0),
(38, '菜頭', 10, '其他類', 0),
(39, '手工大蝦捲', 25, '其他類', 0),
(40, '大熱狗', 25, '其他類', 0),
(41, '德國香腸', 25, '其他類', 0),
(42, '日式玉子燒', 25, '其他類', 0),
(43, '麻辣鴨血臭豆腐', 25, '其他類', 0),
(44, '狀元米腸', 20, '其他類', 0),
(45, '手工牛母', 25, '其他類', 0),
(46, '手工甜不辣', 15, '其他類', 0),
(47, '海帶卷', 10, '其他類', 0),
(48, '小熱狗', 15, '其他類', 0),
(49, '手工黑輪', 15, '其他類', 0),
(50, '雪魚燒', 15, '其他類', 0),
(51, '日式竹輪', 10, '其他類', 0),
(52, '黃金豆腐', 15, '其他類', 0),
(53, '手工鴨米血', 15, '其他類', 0),
(54, '麻辣鴨血', 15, '其他類', 0),
(55, '凍豆腐', 10, '其他類', 0),
(56, '滷蛋', 15, '其他類', 0),
(57, '麻辣臭豆腐', 10, '其他類', 0),
(58, '油條', 15, '其他類', 0),
(59, '手工水晶餃', 15, '其他類', 0),
(60, '雪魚丸', 5, '火鍋料類', 0),
(61, '魚餃', 5, '火鍋料類', 0),
(62, '燕餃', 5, '火鍋料類', 0),
(63, '鴨肉丸', 5, '火鍋料類', 0),
(64, '小蝦球', 5, '火鍋料類', 0),
(65, '魚卵卷', 5, '火鍋料類', 0),
(66, '龍蝦沙拉', 15, '火鍋料類', 0),
(67, '魚包蛋', 15, '火鍋料類', 0),
(68, '爆濃起司球', 15, '火鍋料類', 0),
(69, '麻吉燒（芝麻）', 15, '火鍋料類', 0),
(70, '麻吉燒（花生）', 15, '火鍋料類', 0),
(71, '新竹大貢丸', 15, '火鍋料類', 0),
(72, '蟹肉棒', 15, '火鍋料類', 0),
(73, '起司魚豆腐', 15, '火鍋料類', 0),
(74, '鑫鑫腸', 5, '火鍋料類', 0),
(75, '韓國年糕', 5, '火鍋料類', 0),
(76, '烏蛋', 5, '火鍋料類', 0),
(77, '章魚球', 15, '火鍋料類', 0),
(78, '花椰菜', 30, '蔬菜類', 0),
(79, '水蓮', 25, '蔬菜類', 0),
(80, '高麗菜', 20, '蔬菜類', 0),
(81, '地瓜葉', 20, '蔬菜類', 0),
(82, '空心菜', 20, '蔬菜類', 0),
(83, '娃娃菜', 20, '蔬菜類', 0),
(84, '大陸妹', 20, '蔬菜類', 0),
(85, '洋蔥', 20, '蔬菜類', 0),
(86, '南瓜', 20, '蔬菜類', 0),
(87, '山苦瓜', 20, '蔬菜類', 0),
(88, '青椒', 20, '蔬菜類', 0),
(89, '四季豆', 20, '蔬菜類', 0),
(90, '豆芽菜', 20, '蔬菜類', 0),
(91, '玉米筍', 20, '蔬菜類', 0),
(92, '極品香菇', 20, '香菇類', 0),
(93, '秀針菇', 20, '香菇類', 0),
(94, '杏鮑菇', 20, '香菇類', 0),
(95, '特選黑木耳', 20, '香菇類', 0),
(96, '金針菇', 20, '香菇類', 0),
(97, '菠菜', 20, '冬季蔬菜類', 0),
(98, '茼蒿', 20, '冬季蔬菜類', 0),
(99, '山茼蒿', 20, '冬季蔬菜類', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL COMMENT '訂單ID',
  `order_date` datetime NOT NULL COMMENT '訂單時間',
  `customer_id` int(11) DEFAULT NULL COMMENT '顧客（外部鍵）',
  `status` varchar(50) DEFAULT NULL COMMENT '訂單狀態'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `order_item`
--

CREATE TABLE `order_item` (
  `item_id` int(11) NOT NULL COMMENT '訂單明細ID',
  `order_id` int(11) DEFAULT NULL COMMENT '訂單（外部鍵）',
  `menu_id` int(11) DEFAULT NULL COMMENT '菜單項目（外部鍵）',
  `quantity` int(11) NOT NULL COMMENT '數量',
  `unit_price` int(11) NOT NULL COMMENT '單價'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `recipe`
--

CREATE TABLE `recipe` (
  `recipe_id` int(11) NOT NULL COMMENT '配方ID',
  `menu_id` int(11) DEFAULT NULL COMMENT '菜單（外部鍵）',
  `ingredient_id` int(11) DEFAULT NULL COMMENT '原料（外部鍵）',
  `amount` int(11) NOT NULL COMMENT '用量'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_customer_name` (`name`) COMMENT '依顧客姓名快速查詢的索引';

--
-- 資料表索引 `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`ingredient_id`),
  ADD KEY `idx_ingredient_name` (`name`) COMMENT '依原料名稱快速查詢的索引';

--
-- 資料表索引 `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`),
  ADD KEY `ingredient_id` (`ingredient_id`);

--
-- 資料表索引 `menu_item`
--
ALTER TABLE `menu_item`
  ADD PRIMARY KEY (`menu_id`),
  ADD KEY `idx_menu_item_name` (`name`) COMMENT '依菜單項目名稱快速查詢的索引';

--
-- 資料表索引 `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `idx_order_date` (`order_date`) COMMENT '依訂單日期快速查詢的索引';

--
-- 資料表索引 `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- 資料表索引 `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`recipe_id`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `ingredient_id` (`ingredient_id`);

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`ingredient_id`);

--
-- 資料表的限制式 `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- 資料表的限制式 `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`),
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `menu_item` (`menu_id`);

--
-- 資料表的限制式 `recipe`
--
ALTER TABLE `recipe`
  ADD CONSTRAINT `recipe_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu_item` (`menu_id`),
  ADD CONSTRAINT `recipe_ibfk_2` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`ingredient_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
