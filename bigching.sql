-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2025-04-06 11:19:37
-- 伺服器版本： 10.4.28-MariaDB
-- PHP 版本： 8.2.4

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
  `Customer_ID` int(11) NOT NULL,
  `Customer_name` varchar(100) DEFAULT NULL,
  `Customer_mail` varchar(100) DEFAULT NULL,
  `Customer_phonenumber` int(20) DEFAULT NULL COMMENT '客戶電話'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `ingredient`
--

CREATE TABLE `ingredient` (
  `ingredient_ID` int(11) NOT NULL,
  `ingredient_name` varchar(100) NOT NULL,
  `unit` varchar(100) NOT NULL COMMENT '單位',
  `current_stock` int(11) NOT NULL COMMENT '目前庫存'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `menu`
--

CREATE TABLE `menu` (
  `menu_ID` int(11) NOT NULL,
  `menu_name` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `is_available` tinyint(4) NOT NULL COMMENT '是否供應'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `menu`
--

INSERT INTO `menu` (`menu_ID`, `menu_name`, `price`, `category`, `description`, `is_available`) VALUES
(1, '霸王海鮮鍋', '120', '火鍋類', '', 0),
(2, '死神辣辣麵', '150', '火鍋類', '', 0),
(3, '麻辣套餐', '150', '火鍋類', '', 0),
(4, '麻辣鴨血臭臭鍋', '120', '火鍋類', '', 0),
(5, '韓式泡菜臭臭鍋', '120', '火鍋類', '', 0),
(6, '大腸鴨血臭臭鍋', '120', '火鍋類', '', 0),
(7, '招牌鴨血臭臭鍋', '100', '火鍋類', '', 0),
(8, '韓國拉麵', '35', '主食麵類', '', 0),
(9, '蒸煮麵', '25', '主食麵類', '', 0),
(10, '媽媽拉麵', '20', '主食麵類', '', 0),
(11, '烏龍麵', '25', '主食麵類', '', 0),
(12, '王子麵', '15', '主食麵類', '', 0),
(13, '極品意麵', '20', '主食麵類', '', 0),
(14, '極品雞絲麵', '20', '主食麵類', '', 0),
(15, '統一脆麵', '20', '主食麵類', '', 0),
(16, '關廟麵', '20', '主食麵類', '', 0),
(17, '入味冬粉', '15', '主食麵類', '', 0),
(18, '入味河粉', '15', '主食麵類', '', 0),
(19, '無骨湯燒雞排', '35', '上等肉類', '', 0),
(20, '滷肉排', '35', '上等肉類', '', 0),
(21, '豬肉片', '30', '上等肉類', '', 0),
(22, '牛肉片', '30', '上等肉類', '', 0),
(23, '隔間肉', '40', '上等肉類', '', 0),
(24, '大腸', '40', '上等肉類', '', 0),
(25, '粉腸', '40', '上等肉類', '', 0),
(26, '豬頭皮', '30', '上等肉類', '', 0),
(27, '豬耳朵', '30', '上等肉類', '', 0),
(28, '豬舌頭', '30', '上等肉類', '', 0),
(29, '鴨胗', '20', '上等肉類', '', 0),
(30, '豬皮', '15', '上等肉類', '', 0),
(31, '鴨心', '20', '上等肉類', '', 0),
(32, '手工大黑豆干', '25', '豆品類', '', 0),
(33, '五香豆干', '15', '豆品類', '', 0),
(34, '手工蘭花干', '25', '豆品類', '', 0),
(35, '手工豆包', '10', '豆品類', '', 0),
(36, '手工百頁豆腐', '15', '豆品類', '', 0),
(37, '上等大油皮', '20', '豆品類', '', 0),
(38, '菜頭', '10', '其他類', '', 0),
(39, '手工大蝦捲', '25', '其他類', '', 0),
(40, '大熱狗', '25', '其他類', '', 0),
(41, '德國香腸', '25', '其他類', '', 0),
(42, '日式玉子燒', '25', '其他類', '', 0),
(43, '麻辣鴨血臭豆腐', '25', '其他類', '', 0),
(44, '狀元米腸', '20', '其他類', '', 0),
(45, '手工牛母', '25', '其他類', '', 0),
(46, '手工甜不辣', '15', '其他類', '', 0),
(47, '海帶卷', '10', '其他類', '', 0),
(48, '小熱狗', '15', '其他類', '', 0),
(49, '手工黑輪', '15', '其他類', '', 0),
(50, '雪魚燒', '15', '其他類', '', 0),
(51, '日式竹輪', '10', '其他類', '', 0),
(52, '黃金豆腐', '15', '其他類', '', 0),
(53, '手工鴨米血', '15', '其他類', '', 0),
(54, '麻辣鴨血', '15', '其他類', '', 0),
(55, '凍豆腐', '10', '其他類', '', 0),
(56, '滷蛋', '15', '其他類', '', 0),
(57, '麻辣臭豆腐', '10', '其他類', '', 0),
(58, '油條', '15', '其他類', '', 0),
(59, '手工水晶餃', '15', '其他類', '', 0),
(60, '雪魚丸', '5', '火鍋類', '', 0),
(61, '魚餃', '5', '火鍋類', '', 0),
(62, '燕餃', '5', '火鍋類', '', 0),
(63, '鴨肉丸', '5', '火鍋類', '', 0),
(64, '小蝦球', '5', '火鍋類', '', 0),
(65, '魚卵卷', '5', '火鍋類', '', 0),
(66, '龍蝦沙拉', '15', '火鍋類', '', 0),
(67, '魚包蛋', '15', '火鍋類', '', 0),
(68, '爆濃起司球', '15', '火鍋類', '', 0),
(69, '麻吉燒（芝麻）', '15', '火鍋類', '', 0),
(70, '麻吉燒（花生）', '15', '火鍋類', '', 0),
(71, '新竹大貢丸', '15', '火鍋類', '', 0),
(72, '蟹肉棒', '15', '火鍋類', '', 0),
(73, '起司魚豆腐', '15', '火鍋類', '', 0),
(74, '鑫鑫腸', '5', '火鍋類', '', 0),
(75, '韓國年糕', '5', '火鍋類', '', 0),
(76, '烏蛋', '5', '火鍋類', '', 0),
(77, '章魚球', '15', '火鍋類', '', 0),
(78, '花椰菜', '30', '蔬菜類', '', 0),
(79, '水蓮', '25', '蔬菜類', '', 0),
(80, '高麗菜', '20', '蔬菜類', '', 0),
(81, '地瓜葉', '20', '蔬菜類', '', 0),
(82, '空心菜', '20', '蔬菜類', '', 0),
(83, '娃娃菜', '20', '蔬菜類', '', 0),
(84, '大陸妹', '20', '蔬菜類', '', 0),
(85, '洋蔥', '20', '蔬菜類', '', 0),
(86, '南瓜', '20', '蔬菜類', '', 0),
(87, '山苦瓜', '20', '蔬菜類', '', 0),
(88, '青椒', '20', '蔬菜類', '', 0),
(89, '四季豆', '20', '蔬菜類', '', 0),
(90, '豆芽菜', '20', '蔬菜類', '', 0),
(91, '玉米筍', '20', '蔬菜類', '', 0),
(92, '極品香菇', '20', '香菇類', '', 0),
(93, '秀針菇', '20', '香菇類', '', 0),
(94, '杏鮑菇', '20', '香菇類', '', 0),
(95, '特選黑木耳', '20', '香菇類', '', 0),
(96, '金針菇', '20', '香菇類', '', 0),
(97, '菠菜', '20', '冬季蔬菜類', '', 0),
(98, '茼蒿', '20', '冬季蔬菜類', '', 0),
(99, '山茼蒿', '20', '冬季蔬菜類', '', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `my_order`
--

CREATE TABLE `my_order` (
  `Order_ID` int(11) NOT NULL,
  `Order_eat` varchar(100) NOT NULL,
  `Order_q` int(11) NOT NULL,
  `Order_Date` datetime NOT NULL,
  `Customer_ID` int(11) NOT NULL,
  `Menu_ID` int(11) NOT NULL,
  `Remark` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `qa`
--

CREATE TABLE `qa` (
  `QA_ID` int(11) NOT NULL,
  `Q` text NOT NULL,
  `A` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `recipe`
--

CREATE TABLE `recipe` (
  `recipe_ID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `menu_ID` int(11) NOT NULL,
  `ingredient_ID` int(11) NOT NULL,
  `notes` text NOT NULL COMMENT '特殊處理說明'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Customer_ID`);

--
-- 資料表索引 `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_ID`);

--
-- 資料表索引 `my_order`
--
ALTER TABLE `my_order`
  ADD PRIMARY KEY (`Order_ID`,`Customer_ID`);

--
-- 資料表索引 `qa`
--
ALTER TABLE `qa`
  ADD PRIMARY KEY (`QA_ID`);

--
-- 資料表索引 `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`recipe_ID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
