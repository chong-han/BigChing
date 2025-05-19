-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2025-05-18 09:21:00
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
  `Customer_ID` int(11) NOT NULL COMMENT '顧客 ID',
  `Customer_name` varchar(100) DEFAULT NULL COMMENT '顧客姓名',
  `Customer_mail` varchar(100) DEFAULT NULL COMMENT '顧客電子郵件',
  `Customer_phone` varchar(20) DEFAULT NULL COMMENT '顧客電話'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `customer`
--

INSERT INTO `customer` (`Customer_ID`, `Customer_name`, `Customer_mail`, `Customer_phone`) VALUES
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
-- 資料表結構 `hotpot`
--

CREATE TABLE `hotpot` (
  `HotPot_ID` int(11) NOT NULL COMMENT '火鍋類型 ID',
  `HotPot_name` varchar(100) DEFAULT NULL COMMENT '火鍋名稱',
  `Ingredient_ID` int(11) NOT NULL COMMENT '食材 ID (外鍵)',
  `quantity` int(11) DEFAULT NULL COMMENT '對應食材用量'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `hotpot`
--

INSERT INTO `hotpot` (`HotPot_ID`, `HotPot_name`, `Ingredient_ID`, `quantity`) VALUES
(1, '霸王海鮮鍋', 22, 1),
(1, '霸王海鮮鍋', 54, 1),
(1, '霸王海鮮鍋', 60, 1),
(1, '霸王海鮮鍋', 64, 1),
(1, '霸王海鮮鍋', 72, 2),
(1, '霸王海鮮鍋', 79, 1),
(2, '死神辣辣麵', 21, 1),
(2, '死神辣辣麵', 54, 1),
(2, '死神辣辣麵', 61, 1),
(2, '死神辣辣麵', 64, 1),
(2, '死神辣辣麵', 68, 1),
(2, '死神辣辣麵', 80, 1),
(3, '麻辣套餐', 23, 1),
(3, '麻辣套餐', 57, 1),
(3, '麻辣套餐', 62, 1),
(3, '麻辣套餐', 63, 1),
(3, '麻辣套餐', 65, 1),
(3, '麻辣套餐', 81, 1),
(4, '麻辣鴨血臭臭鍋', 54, 1),
(4, '麻辣鴨血臭臭鍋', 57, 1),
(4, '麻辣鴨血臭臭鍋', 61, 1),
(4, '麻辣鴨血臭臭鍋', 86, 1),
(4, '麻辣鴨血臭臭鍋', 92, 1),
(5, '韓式泡菜臭臭鍋', 21, 1),
(5, '韓式泡菜臭臭鍋', 54, 1),
(5, '韓式泡菜臭臭鍋', 60, 1),
(5, '韓式泡菜臭臭鍋', 66, 1),
(5, '韓式泡菜臭臭鍋', 85, 1),
(6, '大腸鴨血臭臭鍋', 24, 1),
(6, '大腸鴨血臭臭鍋', 54, 1),
(6, '大腸鴨血臭臭鍋', 61, 1),
(6, '大腸鴨血臭臭鍋', 81, 1),
(6, '大腸鴨血臭臭鍋', 91, 1),
(7, '招牌鴨血臭臭鍋', 54, 2),
(7, '招牌鴨血臭臭鍋', 57, 1),
(7, '招牌鴨血臭臭鍋', 62, 1),
(7, '招牌鴨血臭臭鍋', 64, 1),
(7, '招牌鴨血臭臭鍋', 79, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `ingredient`
--

CREATE TABLE `ingredient` (
  `Ingredient_ID` int(11) NOT NULL COMMENT '食材 ID',
  `Ingredient_name` varchar(100) DEFAULT NULL COMMENT '食材名稱',
  `unit` varchar(20) DEFAULT NULL COMMENT '單位（例如：克、份）',
  `current_stock` int(11) DEFAULT NULL COMMENT '目前庫存數量'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `ingredient`
--

INSERT INTO `ingredient` (`Ingredient_ID`, `Ingredient_name`, `unit`, `current_stock`) VALUES
(1, '韓國拉麵', '份', 100),
(2, '蒸煮麵', '份', 100),
(3, '媽媽拉麵', '份', 100),
(4, '烏龍麵', '份', 100),
(5, '王子麵', '份', 100),
(6, '極品意麵', '份', 100),
(7, '極品雞絲麵', '份', 100),
(8, '統一脆麵', '份', 100),
(9, '關廟麵', '份', 100),
(10, '入味冬粉', '份', 100),
(11, '入味河粉', '份', 100),
(12, '無骨湯燒雞排', '份', 100),
(13, '滷肉排', '份', 100),
(14, '豬肉片', '份', 100),
(15, '牛肉片', '份', 100),
(16, '隔間肉', '份', 100),
(17, '大腸', '份', 100),
(18, '粉腸', '份', 100),
(19, '豬頭皮', '份', 100),
(20, '豬耳朵', '份', 100),
(21, '豬舌頭', '份', 100),
(22, '鴨胗', '份', 100),
(23, '豬皮', '份', 100),
(24, '鴨心', '份', 100),
(25, '手工大黑豆干', '份', 100),
(26, '五香豆干', '份', 100),
(27, '手工蘭花干', '份', 100),
(28, '手工豆包', '份', 100),
(29, '手工百頁豆腐', '份', 100),
(30, '上等大油皮', '份', 100),
(31, '菜頭', '份', 100),
(32, '手工大蝦捲', '份', 100),
(33, '大熱狗', '份', 100),
(34, '德國香腸', '份', 100),
(35, '日式玉子燒', '份', 100),
(36, '麻辣鴨血臭豆腐', '份', 100),
(37, '狀元米腸', '份', 100),
(38, '手工牛母', '份', 100),
(39, '手工甜不辣', '份', 100),
(40, '海帶卷', '份', 100),
(41, '小熱狗', '份', 100),
(42, '手工黑輪', '份', 100),
(43, '雪魚燒', '份', 100),
(44, '日式竹輪', '份', 100),
(45, '黃金豆腐', '份', 100),
(46, '手工鴨米血', '份', 100),
(47, '麻辣鴨血', '份', 100),
(48, '凍豆腐', '份', 100),
(49, '滷蛋', '份', 100),
(50, '麻辣臭豆腐', '份', 100),
(51, '油條', '份', 100),
(52, '手工水晶餃', '份', 100),
(53, '雪魚丸', '粒', 300),
(54, '魚餃', '粒', 300),
(55, '燕餃', '粒', 300),
(56, '鴨肉丸', '粒', 300),
(57, '小蝦球', '粒', 300),
(58, '魚卵卷', '片', 300),
(59, '龍蝦沙拉', '份', 100),
(60, '魚包蛋', '顆', 100),
(61, '爆濃起司球', '顆', 100),
(62, '麻吉燒（芝麻）', '顆', 100),
(63, '麻吉燒（花生）', '顆', 100),
(64, '新竹大貢丸', '顆', 100),
(65, '蟹肉棒', '條', 100),
(66, '起司魚豆腐', '塊', 100),
(67, '鑫鑫腸', '條', 100),
(68, '韓國年糕', '條', 100),
(69, '烏蛋', '顆', 100),
(70, '章魚球', '顆', 100),
(71, '花椰菜', '份', 100),
(72, '水蓮', '份', 100),
(73, '高麗菜', '份', 100),
(74, '地瓜葉', '份', 100),
(75, '空心菜', '份', 100),
(76, '娃娃菜', '份', 100),
(77, '大陸妹', '份', 100),
(78, '洋蔥', '份', 100),
(79, '南瓜', '份', 100),
(80, '山苦瓜', '份', 100),
(81, '青椒', '份', 100),
(82, '四季豆', '份', 100),
(83, '豆芽菜', '份', 100),
(84, '玉米筍', '份', 100),
(85, '極品香菇', '份', 100),
(86, '秀珍菇', '份', 100),
(87, '杏鮑菇', '份', 100),
(88, '特選黑木耳', '份', 100),
(89, '金針菇', '份', 100),
(90, '菠菜', '份', 100),
(91, '茼蒿', '份', 100),
(92, '山茼蒿', '份', 100);

-- --------------------------------------------------------

--
-- 資料表結構 `menu`
--

CREATE TABLE `menu` (
  `Menu_ID` int(11) NOT NULL COMMENT '菜單 ID',
  `Product_ID` int(11) DEFAULT NULL COMMENT '產品 ID (外鍵)',
  `Menu_name` varchar(100) DEFAULT NULL COMMENT '品項名稱',
  `sell_price` decimal(10,2) DEFAULT NULL COMMENT '售價',
  `category` varchar(50) DEFAULT NULL COMMENT '分類',
  `is_available` tinyint(4) NOT NULL DEFAULT 1 COMMENT '是否上架 (0: 否, 1: 是)	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `menu`
--

INSERT INTO `menu` (`Menu_ID`, `Product_ID`, `Menu_name`, `sell_price`, `category`, `is_available`) VALUES
(1, 1, '霸王海鮮鍋', 120.00, '火鍋類', 1),
(2, 2, '死神辣辣麵', 150.00, '火鍋類', 1),
(3, 3, '麻辣套餐', 150.00, '火鍋類', 1),
(4, 4, '麻辣鴨血臭臭鍋', 120.00, '火鍋類', 1),
(5, 5, '韓式泡菜臭臭鍋', 120.00, '火鍋類', 1),
(6, 6, '大腸鴨血臭臭鍋', 120.00, '火鍋類', 1),
(7, 7, '招牌鴨血臭臭鍋', 100.00, '火鍋類', 1),
(8, 8, '韓國拉麵', 35.00, '主食麵類', 1),
(9, 9, '蒸煮麵', 25.00, '主食麵類', 1),
(10, 10, '媽媽拉麵', 20.00, '主食麵類', 1),
(11, 11, '烏龍麵', 25.00, '主食麵類', 1),
(12, 12, '王子麵', 15.00, '主食麵類', 1),
(13, 13, '極品意麵', 20.00, '主食麵類', 1),
(14, 14, '極品雞絲麵', 20.00, '主食麵類', 1),
(15, 15, '統一脆麵', 20.00, '主食麵類', 1),
(16, 16, '關廟麵', 20.00, '主食麵類', 1),
(17, 17, '入味冬粉', 15.00, '主食麵類', 1),
(18, 18, '入味河粉', 15.00, '主食麵類', 1),
(19, 19, '無骨湯燒雞排', 35.00, '上等肉類', 1),
(20, 20, '滷肉排', 35.00, '上等肉類', 1),
(21, 21, '豬肉片', 30.00, '上等肉類', 1),
(22, 22, '牛肉片', 30.00, '上等肉類', 1),
(23, 23, '隔間肉', 40.00, '上等肉類', 1),
(24, 24, '大腸', 40.00, '上等肉類', 1),
(25, 25, '粉腸', 40.00, '上等肉類', 1),
(26, 26, '豬頭皮', 30.00, '上等肉類', 1),
(27, 27, '豬耳朵', 30.00, '上等肉類', 1),
(28, 28, '豬舌頭', 30.00, '上等肉類', 1),
(29, 29, '鴨胗', 20.00, '上等肉類', 1),
(30, 30, '豬皮', 15.00, '上等肉類', 1),
(31, 31, '鴨心', 20.00, '上等肉類', 1),
(32, 32, '手工大黑豆干', 25.00, '豆品類', 1),
(33, 33, '五香豆干', 15.00, '豆品類', 1),
(34, 34, '手工蘭花干', 25.00, '豆品類', 1),
(35, 35, '手工豆包', 10.00, '豆品類', 1),
(36, 36, '手工百頁豆腐', 15.00, '豆品類', 1),
(37, 37, '上等大油皮', 20.00, '豆品類', 1),
(38, 38, '菜頭', 10.00, '其他類', 1),
(39, 39, '手工大蝦捲', 25.00, '其他類', 1),
(40, 40, '大熱狗', 25.00, '其他類', 1),
(41, 41, '德國香腸', 25.00, '其他類', 1),
(42, 42, '日式玉子燒', 25.00, '其他類', 1),
(43, 43, '麻辣鴨血臭豆腐', 25.00, '其他類', 1),
(44, 44, '狀元米腸', 20.00, '其他類', 1),
(45, 45, '手工牛母', 25.00, '其他類', 1),
(46, 46, '手工甜不辣', 15.00, '其他類', 1),
(47, 47, '海帶卷', 10.00, '其他類', 1),
(48, 48, '小熱狗', 15.00, '其他類', 1),
(49, 49, '手工黑輪', 15.00, '其他類', 1),
(50, 50, '雪魚燒', 15.00, '其他類', 1),
(51, 51, '日式竹輪', 10.00, '其他類', 1),
(52, 52, '黃金豆腐', 15.00, '其他類', 1),
(53, 53, '手工鴨米血', 15.00, '其他類', 1),
(54, 54, '麻辣鴨血', 15.00, '其他類', 1),
(55, 55, '凍豆腐', 10.00, '其他類', 1),
(56, 56, '滷蛋', 15.00, '其他類', 1),
(57, 57, '麻辣臭豆腐', 10.00, '其他類', 1),
(58, 58, '油條', 15.00, '其他類', 1),
(59, 59, '手工水晶餃', 15.00, '其他類', 1),
(60, 60, '雪魚丸', 5.00, '火鍋料類', 1),
(61, 61, '魚餃', 5.00, '火鍋料類', 1),
(62, 62, '燕餃', 5.00, '火鍋料類', 1),
(63, 63, '鴨肉丸', 5.00, '火鍋料類', 1),
(64, 64, '小蝦球', 5.00, '火鍋料類', 1),
(65, 65, '魚卵卷', 5.00, '火鍋料類', 1),
(66, 66, '龍蝦沙拉', 15.00, '火鍋料類', 1),
(67, 67, '魚包蛋', 15.00, '火鍋料類', 1),
(68, 68, '爆濃起司球', 15.00, '火鍋料類', 1),
(69, 69, '麻吉燒（芝麻）', 15.00, '火鍋料類', 1),
(70, 70, '麻吉燒（花生）', 15.00, '火鍋料類', 1),
(71, 71, '新竹大貢丸', 15.00, '火鍋料類', 1),
(72, 72, '蟹肉棒', 15.00, '火鍋料類', 1),
(73, 73, '起司魚豆腐', 15.00, '火鍋料類', 1),
(74, 74, '鑫鑫腸', 5.00, '火鍋料類', 1),
(75, 75, '韓國年糕', 5.00, '火鍋料類', 1),
(76, 76, '烏蛋', 5.00, '火鍋料類', 1),
(77, 77, '章魚球', 15.00, '火鍋料類', 1),
(78, 78, '花椰菜', 30.00, '蔬菜類', 1),
(79, 79, '水蓮', 25.00, '蔬菜類', 1),
(80, 80, '高麗菜', 20.00, '蔬菜類', 1),
(81, 81, '地瓜葉', 20.00, '蔬菜類', 1),
(82, 82, '空心菜', 20.00, '蔬菜類', 1),
(83, 83, '娃娃菜', 20.00, '蔬菜類', 1),
(84, 84, '大陸妹', 20.00, '蔬菜類', 1),
(85, 85, '洋蔥', 20.00, '蔬菜類', 1),
(86, 86, '南瓜', 20.00, '蔬菜類', 1),
(87, 87, '山苦瓜', 20.00, '蔬菜類', 1),
(88, 88, '青椒', 20.00, '蔬菜類', 1),
(89, 89, '四季豆', 20.00, '蔬菜類', 1),
(90, 90, '豆芽菜', 20.00, '蔬菜類', 1),
(91, 91, '玉米筍', 20.00, '蔬菜類', 1),
(92, 92, '極品香菇', 20.00, '香菇類', 1),
(93, 93, '秀針菇', 20.00, '香菇類', 1),
(94, 94, '杏鮑菇', 20.00, '香菇類', 1),
(95, 95, '特選黑木耳', 20.00, '香菇類', 1),
(96, 96, '金針菇', 20.00, '香菇類', 1),
(97, 97, '菠菜', 20.00, '冬季蔬菜類', 1),
(98, 98, '茼蒿', 20.00, '冬季蔬菜類', 1),
(99, 99, '山茼蒿', 20.00, '冬季蔬菜類', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `order`
--

CREATE TABLE `order` (
  `Order_ID` int(11) NOT NULL COMMENT '訂單 ID',
  `Customer_ID` int(11) DEFAULT NULL COMMENT '顧客 ID (外鍵)',
  `Order_Date` date DEFAULT NULL COMMENT '訂購日期',
  `Order_exit` tinyint(4) DEFAULT NULL COMMENT '訂單是否已完成 (0=否, 1=是)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `order_item`
--

CREATE TABLE `order_item` (
  `Item_ID` int(11) NOT NULL COMMENT '訂單項目 ID',
  `Menu_ID` int(11) DEFAULT NULL COMMENT '菜單品項 ID (外鍵)',
  `Order_ID` int(11) DEFAULT NULL COMMENT '訂單 ID (外鍵)',
  `quantity` int(11) DEFAULT NULL COMMENT '數量',
  `unit_price` decimal(10,2) DEFAULT NULL COMMENT '單價'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `Product_ID` int(11) NOT NULL COMMENT '產品 ID',
  `cost_price` decimal(10,2) DEFAULT NULL COMMENT '成本價格',
  `Ingredient_ID` int(11) DEFAULT NULL COMMENT '食材 ID (外鍵)',
  `HotPot_ID` int(11) DEFAULT NULL COMMENT '火鍋類型 ID (外鍵)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`Product_ID`, `cost_price`, `Ingredient_ID`, `HotPot_ID`) VALUES
(1, 115.00, NULL, 1),
(2, 145.00, NULL, 2),
(3, 145.00, NULL, 3),
(4, 115.00, NULL, 4),
(5, 115.00, NULL, 5),
(6, 115.00, NULL, 6),
(7, 95.00, NULL, 7),
(8, 30.00, 1, NULL),
(9, 20.00, 2, NULL),
(10, 15.00, 3, NULL),
(11, 20.00, 4, NULL),
(12, 10.00, 5, NULL),
(13, 15.00, 6, NULL),
(14, 15.00, 7, NULL),
(15, 15.00, 8, NULL),
(16, 15.00, 9, NULL),
(17, 10.00, 10, NULL),
(18, 10.00, 11, NULL),
(19, 30.00, 12, NULL),
(20, 30.00, 13, NULL),
(21, 25.00, 14, NULL),
(22, 25.00, 15, NULL),
(23, 35.00, 16, NULL),
(24, 35.00, 17, NULL),
(25, 35.00, 18, NULL),
(26, 25.00, 19, NULL),
(27, 25.00, 20, NULL),
(28, 25.00, 21, NULL),
(29, 15.00, 22, NULL),
(30, 10.00, 23, NULL),
(31, 15.00, 24, NULL),
(32, 20.00, 25, NULL),
(33, 10.00, 26, NULL),
(34, 20.00, 27, NULL),
(35, 5.00, 28, NULL),
(36, 10.00, 29, NULL),
(37, 15.00, 30, NULL),
(38, 5.00, 31, NULL),
(39, 20.00, 32, NULL),
(40, 20.00, 33, NULL),
(41, 20.00, 34, NULL),
(42, 20.00, 35, NULL),
(43, 20.00, 36, NULL),
(44, 15.00, 37, NULL),
(45, 20.00, 38, NULL),
(46, 10.00, 39, NULL),
(47, 5.00, 40, NULL),
(48, 10.00, 41, NULL),
(49, 10.00, 42, NULL),
(50, 10.00, 43, NULL),
(51, 5.00, 44, NULL),
(52, 10.00, 45, NULL),
(53, 10.00, 46, NULL),
(54, 10.00, 47, NULL),
(55, 5.00, 48, NULL),
(56, 10.00, 49, NULL),
(57, 5.00, 50, NULL),
(58, 10.00, 51, NULL),
(59, 10.00, 52, NULL),
(60, 5.00, 53, NULL),
(61, 5.00, 54, NULL),
(62, 5.00, 55, NULL),
(63, 5.00, 56, NULL),
(64, 5.00, 57, NULL),
(65, 5.00, 58, NULL),
(66, 10.00, 59, NULL),
(67, 10.00, 60, NULL),
(68, 10.00, 61, NULL),
(69, 10.00, 62, NULL),
(70, 10.00, 63, NULL),
(71, 10.00, 64, NULL),
(72, 10.00, 65, NULL),
(73, 10.00, 66, NULL),
(74, 5.00, 67, NULL),
(75, 5.00, 68, NULL),
(76, 5.00, 69, NULL),
(77, 10.00, 70, NULL),
(78, 25.00, 71, NULL),
(79, 20.00, 72, NULL),
(80, 15.00, 73, NULL),
(81, 15.00, 74, NULL),
(82, 15.00, 75, NULL),
(83, 15.00, 76, NULL),
(84, 15.00, 77, NULL),
(85, 15.00, 78, NULL),
(86, 15.00, 79, NULL),
(87, 15.00, 80, NULL),
(88, 15.00, 81, NULL),
(89, 15.00, 82, NULL),
(90, 15.00, 83, NULL),
(91, 15.00, 84, NULL),
(92, 15.00, 85, NULL),
(93, 15.00, 86, NULL),
(94, 15.00, 87, NULL),
(95, 15.00, 88, NULL),
(96, 15.00, 89, NULL),
(97, 15.00, 90, NULL),
(98, 15.00, 91, NULL),
(99, 15.00, 92, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `qa`
--

CREATE TABLE `qa` (
  `QA_ID` int(11) NOT NULL COMMENT 'QA ID',
  `Q` text DEFAULT NULL COMMENT '問題內容',
  `A` text DEFAULT NULL COMMENT '答案內容'
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
-- 資料表索引 `hotpot`
--
ALTER TABLE `hotpot`
  ADD PRIMARY KEY (`HotPot_ID`,`Ingredient_ID`) USING BTREE,
  ADD KEY `Ingredient_ID` (`Ingredient_ID`);

--
-- 資料表索引 `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`Ingredient_ID`);

--
-- 資料表索引 `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`Menu_ID`),
  ADD KEY `Product_ID` (`Product_ID`);

--
-- 資料表索引 `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`Order_ID`),
  ADD KEY `Customer_ID` (`Customer_ID`);

--
-- 資料表索引 `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`Item_ID`),
  ADD KEY `Menu_ID` (`Menu_ID`),
  ADD KEY `Order_ID` (`Order_ID`);

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_ID`),
  ADD KEY `Ingredient_ID` (`Ingredient_ID`),
  ADD KEY `HotPot_ID` (`HotPot_ID`);

--
-- 資料表索引 `qa`
--
ALTER TABLE `qa`
  ADD PRIMARY KEY (`QA_ID`);

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `hotpot`
--
ALTER TABLE `hotpot`
  ADD CONSTRAINT `hotpot_ibfk_1` FOREIGN KEY (`Ingredient_ID`) REFERENCES `ingredient` (`Ingredient_ID`);

--
-- 資料表的限制式 `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`Product_ID`) REFERENCES `product` (`Product_ID`);

--
-- 資料表的限制式 `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`Customer_ID`) REFERENCES `customer` (`Customer_ID`);

--
-- 資料表的限制式 `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`Menu_ID`) REFERENCES `menu` (`Menu_ID`),
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`Order_ID`) REFERENCES `order` (`Order_ID`);

--
-- 資料表的限制式 `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`Ingredient_ID`) REFERENCES `ingredient` (`Ingredient_ID`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`HotPot_ID`) REFERENCES `hotpot` (`HotPot_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
