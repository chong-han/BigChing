-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2025-03-15 16:21:31
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
  `Customer_phonenumber` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `menu`
--

CREATE TABLE `menu` (
  `Menu_ID` int(11) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `PRICE` varchar(100) NOT NULL,
  `CLASS` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `menu`
--

INSERT INTO `menu` (`Menu_ID`, `NAME`, `PRICE`, `CLASS`) VALUES
(1, '霸王海鮮鍋', '120', '火鍋類'),
(2, '死神辣辣麵', '150', '火鍋類'),
(3, '麻辣套餐', '150', '火鍋類'),
(4, '麻辣鴨血臭臭鍋', '120', '火鍋類'),
(5, '韓式泡菜臭臭鍋', '120', '火鍋類'),
(6, '大腸鴨血臭臭鍋', '120', '火鍋類'),
(7, '招牌鴨血臭臭鍋', '100', '火鍋類'),
(8, '韓國拉麵', '35', '主食麵類'),
(9, '蒸煮麵', '25', '主食麵類'),
(10, '媽媽拉麵', '20', '主食麵類'),
(11, '烏龍麵', '25', '主食麵類'),
(12, '王子麵', '15', '主食麵類'),
(13, '極品意麵', '20', '主食麵類'),
(14, '極品雞絲麵', '20', '主食麵類'),
(15, '統一脆麵', '20', '主食麵類'),
(16, '關廟麵', '20', '主食麵類'),
(17, '入味冬粉', '15', '主食麵類'),
(18, '入味河粉', '15', '主食麵類'),
(19, '無骨湯燒雞排', '35', '上等肉類'),
(20, '滷肉排', '35', '上等肉類'),
(21, '豬肉片', '30', '上等肉類'),
(22, '牛肉片', '30', '上等肉類'),
(23, '隔間肉', '40', '上等肉類'),
(24, '大腸', '40', '上等肉類'),
(25, '粉腸', '40', '上等肉類'),
(26, '豬頭皮', '30', '上等肉類'),
(27, '豬耳朵', '30', '上等肉類'),
(28, '豬舌頭', '30', '上等肉類'),
(29, '鴨胗', '20', '上等肉類'),
(30, '豬皮', '15', '上等肉類'),
(31, '鴨心', '20', '上等肉類'),
(32, '手工大黑豆干', '25', '豆品類'),
(33, '五香豆干', '15', '豆品類'),
(34, '手工蘭花干', '25', '豆品類'),
(35, '手工豆包', '10', '豆品類'),
(36, '手工百頁豆腐', '15', '豆品類'),
(37, '上等大油皮', '20', '豆品類'),
(38, '菜頭', '10', '其他類'),
(39, '手工大蝦捲', '25', '其他類'),
(40, '大熱狗', '25', '其他類'),
(41, '德國香腸', '25', '其他類'),
(42, '日式玉子燒', '25', '其他類'),
(43, '麻辣鴨血臭豆腐', '25', '其他類'),
(44, '狀元米腸', '20', '其他類'),
(45, '手工牛母', '25', '其他類'),
(46, '手工甜不辣', '15', '其他類'),
(47, '海帶卷', '10', '其他類'),
(48, '小熱狗', '15', '其他類'),
(49, '手工黑輪', '15', '其他類'),
(50, '雪魚燒', '15', '其他類'),
(51, '日式竹輪', '10', '其他類'),
(52, '黃金豆腐', '15', '其他類'),
(53, '手工鴨米血', '15', '其他類'),
(54, '麻辣鴨血', '15', '其他類'),
(55, '凍豆腐', '10', '其他類'),
(56, '滷蛋', '15', '其他類'),
(57, '麻辣臭豆腐', '10', '其他類'),
(58, '油條', '15', '其他類'),
(59, '手工水晶餃', '15', '其他類'),
(60, '雪魚丸', '5', '火鍋類'),
(61, '魚餃', '5', '火鍋類'),
(62, '燕餃', '5', '火鍋類'),
(63, '鴨肉丸', '5', '火鍋類'),
(64, '小蝦球', '5', '火鍋類'),
(65, '魚卵卷', '5', '火鍋類'),
(66, '龍蝦沙拉', '15', '火鍋類'),
(67, '魚包蛋', '15', '火鍋類'),
(68, '爆濃起司球', '15', '火鍋類'),
(69, '麻吉燒（芝麻）', '15', '火鍋類'),
(70, '麻吉燒（花生）', '15', '火鍋類'),
(71, '新竹大貢丸', '15', '火鍋類'),
(72, '蟹肉棒', '15', '火鍋類'),
(73, '起司魚豆腐', '15', '火鍋類'),
(74, '鑫鑫腸', '5', '火鍋類'),
(75, '韓國年糕', '5', '火鍋類'),
(76, '烏蛋', '5', '火鍋類'),
(77, '章魚球', '15', '火鍋類'),
(78, '花椰菜', '30', '蔬菜類'),
(79, '水蓮', '25', '蔬菜類'),
(80, '高麗菜', '20', '蔬菜類'),
(81, '地瓜葉', '20', '蔬菜類'),
(82, '空心菜', '20', '蔬菜類'),
(83, '娃娃菜', '20', '蔬菜類'),
(84, '大陸妹', '20', '蔬菜類'),
(85, '洋蔥', '20', '蔬菜類'),
(86, '南瓜', '20', '蔬菜類'),
(87, '山苦瓜', '20', '蔬菜類'),
(88, '青椒', '20', '蔬菜類'),
(89, '四季豆', '20', '蔬菜類'),
(90, '豆芽菜', '20', '蔬菜類'),
(91, '玉米筍', '20', '蔬菜類'),
(92, '極品香菇', '20', '香菇類'),
(93, '秀針菇', '20', '香菇類'),
(94, '杏鮑菇', '20', '香菇類'),
(95, '特選黑木耳', '20', '香菇類'),
(96, '金針菇', '20', '香菇類'),
(97, '菠菜', '20', '冬季蔬菜類'),
(98, '茼蒿', '20', '冬季蔬菜類'),
(99, '山茼蒿', '20', '冬季蔬菜類');

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
-- 資料表結構 `stock`
--

CREATE TABLE `stock` (
  `s_ID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `Menu_ID` int(11) NOT NULL
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
  ADD PRIMARY KEY (`Menu_ID`);

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
-- 資料表索引 `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`s_ID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `menu`
--
ALTER TABLE `menu`
  MODIFY `Menu_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
