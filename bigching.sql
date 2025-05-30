-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2025-05-30 15:50:26
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
  `Customer_ID` int(11) NOT NULL COMMENT '顧客 ID',
  `Customer_name` varchar(100) DEFAULT NULL COMMENT '顧客姓名',
  `Customer_mail` varchar(100) DEFAULT NULL COMMENT '顧客電子郵件',
  `Customer_phone` varchar(20) DEFAULT NULL COMMENT '顧客電話'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `customer`
--

INSERT INTO `customer` (`Customer_ID`, `Customer_name`, `Customer_mail`, `Customer_phone`) VALUES
(1, '林小明', 'xiaoming.lin@example.com', '0912345678'),
(2, '陳美麗', 'meili.chen@example.com', '0923456789'),
(3, '王大志', 'dazhi.wang@example.com', '0934567890'),
(4, '李小華', 'xiaohua.li@example.com', '0945678901'),
(5, '張雅婷', 'yating.zhang@example.com', '0956789012'),
(6, '吳宗憲', 'zongxian.wu@example.com', '0967890123'),
(7, '周芷若', 'zhiruo.zhou@example.com', '0978901234'),
(8, '徐小娟', 'xiaojuan.xu@example.com', '0989012345'),
(9, '蔡宏仁', 'hongren.tsai@example.com', '0990123456'),
(10, '林宜蓁', 'yichen.lin@example.com', '0911222333'),
(11, 'James', 'thriving.gh@gmail.com', '0963937958'),
(13, '廖琮瀚', 'wjian7088@gmail.com', '0907230010');

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
  `Ingredient_ID` int(11) NOT NULL,
  `Ingredient_name` varchar(100) DEFAULT NULL COMMENT '食材名稱',
  `unit` varchar(20) DEFAULT NULL COMMENT '單位（例如：克、份）',
  `current_stock` int(11) DEFAULT NULL COMMENT '目前庫存數量'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `ingredient`
--

INSERT INTO `ingredient` (`Ingredient_ID`, `Ingredient_name`, `unit`, `current_stock`) VALUES
(1, '韓國拉麵', '份', 100),
(2, '蒸煮麵', '份', 99),
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
(13, '滷肉排', '份', 98),
(14, '豬肉片', '份', 99),
(15, '牛肉片', '份', 100),
(16, '隔間肉', '份', 100),
(17, '大腸', '份', 100),
(18, '粉腸', '份', 100),
(19, '豬頭皮', '份', 100),
(20, '豬耳朵', '份', 100),
(21, '豬舌頭', '份', 91),
(22, '鴨胗', '份', 97),
(23, '豬皮', '份', 95),
(24, '鴨心', '份', 98),
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
(53, '雪魚丸', '粒', 299),
(54, '魚餃', '粒', 285),
(55, '燕餃', '粒', 300),
(56, '鴨肉丸', '粒', 300),
(57, '小蝦球', '粒', 295),
(58, '魚卵卷', '片', 300),
(59, '龍蝦沙拉', '份', 100),
(60, '魚包蛋', '顆', 94),
(61, '爆濃起司球', '顆', 92),
(62, '麻吉燒（芝麻）', '顆', 95),
(63, '麻吉燒（花生）', '顆', 95),
(64, '新竹大貢丸', '顆', 91),
(65, '蟹肉棒', '條', 95),
(66, '起司魚豆腐', '塊', 97),
(67, '鑫鑫腸', '條', 100),
(68, '韓國年糕', '條', 94),
(69, '烏蛋', '顆', 100),
(70, '章魚球', '顆', 100),
(71, '花椰菜', '份', 100),
(72, '水蓮', '份', 94),
(73, '高麗菜', '份', 100),
(74, '地瓜葉', '份', 100),
(75, '空心菜', '份', 100),
(76, '娃娃菜', '份', 100),
(77, '大陸妹', '份', 100),
(78, '洋蔥', '份', 100),
(79, '南瓜', '份', 97),
(80, '山苦瓜', '份', 94),
(81, '青椒', '份', 93),
(82, '四季豆', '份', 100),
(83, '豆芽菜', '份', 100),
(84, '玉米筍', '份', 100),
(85, '極品香菇', '份', 97),
(86, '秀珍菇', '份', 100),
(87, '杏鮑菇', '份', 100),
(88, '特選黑木耳', '份', 100),
(89, '金針菇', '份', 100),
(90, '菠菜', '份', 100),
(91, '茼蒿', '份', 98),
(92, '山茼蒿', '份', 99);

-- --------------------------------------------------------

--
-- 資料表結構 `menu`
--

CREATE TABLE `menu` (
  `Menu_ID` int(11) NOT NULL,
  `Product_ID` int(11) DEFAULT NULL COMMENT '產品 ID (外鍵)',
  `Menu_name` varchar(100) DEFAULT NULL COMMENT '品項名稱',
  `sell_price` int(11) DEFAULT NULL COMMENT '售價',
  `category` varchar(50) DEFAULT NULL COMMENT '分類',
  `is_available` tinyint(4) NOT NULL DEFAULT 1 COMMENT '是否上架 (0: 否, 1: 是)	',
  `pic` varchar(255) DEFAULT NULL COMMENT '菜品圖片'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `menu`
--

INSERT INTO `menu` (`Menu_ID`, `Product_ID`, `Menu_name`, `sell_price`, `category`, `is_available`, `pic`) VALUES
(1, 1, '霸王海鮮鍋', 120, '火鍋類', 1, 'bigching_pic/霸王海鮮鍋.jpg'),
(2, 2, '死神辣辣麵', 150, '火鍋類', 1, 'bigching_pic/死神辣辣麵.jpg'),
(3, 3, '麻辣套餐', 150, '火鍋類', 1, 'bigching_pic/麻辣套餐.jpg'),
(4, 4, '麻辣鴨血臭臭鍋', 120, '火鍋類', 1, 'bigching_pic/麻辣鴨血臭臭鍋.jpg'),
(5, 5, '韓式泡菜臭臭鍋', 120, '火鍋類', 1, 'bigching_pic/韓式泡菜臭臭鍋.jpg'),
(6, 6, '大腸鴨血臭臭鍋', 120, '火鍋類', 1, 'bigching_pic/大腸鴨血臭臭鍋.jpg'),
(7, 7, '招牌鴨血臭臭鍋', 100, '火鍋類', 1, 'bigching_pic/招牌鴨血臭臭鍋.jpg'),
(8, 8, '韓國拉麵', 35, '主食麵類', 1, 'bigching_pic/韓國拉麵.jpg'),
(9, 9, '蒸煮麵', 25, '主食麵類', 1, 'bigching_pic/蒸煮麵.jpg'),
(10, 10, '媽媽拉麵', 20, '主食麵類', 1, 'bigching_pic/媽媽拉麵.jpg'),
(11, 11, '烏龍麵', 25, '主食麵類', 1, 'bigching_pic/烏龍麵.jpg'),
(12, 12, '王子麵', 15, '主食麵類', 1, 'bigching_pic/王子麵.jpg'),
(13, 13, '極品意麵', 20, '主食麵類', 1, 'bigching_pic/極品意麵.jpg'),
(14, 14, '極品雞絲麵', 20, '主食麵類', 1, 'bigching_pic/極品雞絲麵.jpg'),
(15, 15, '統一脆麵', 20, '主食麵類', 1, 'bigching_pic/統一脆麵.jpg'),
(16, 16, '關廟麵', 20, '主食麵類', 1, 'bigching_pic/關廟麵.jpg'),
(17, 17, '入味冬粉', 15, '主食麵類', 1, 'bigching_pic/入味冬粉.jpg'),
(18, 18, '入味河粉', 15, '主食麵類', 1, 'bigching_pic/入味河粉.jpg'),
(19, 19, '無骨湯燒雞排', 35, '上等肉類', 1, 'bigching_pic/無骨湯燒雞排.jpg'),
(20, 20, '滷肉排', 35, '上等肉類', 1, 'bigching_pic/滷肉排.jpg'),
(21, 21, '豬肉片', 30, '上等肉類', 1, 'bigching_pic/豬肉片.jpg'),
(22, 22, '牛肉片', 30, '上等肉類', 1, 'bigching_pic/牛肉片.jpg'),
(23, 23, '隔間肉', 40, '上等肉類', 1, 'bigching_pic/隔間肉.jpg'),
(24, 24, '大腸', 40, '上等肉類', 1, 'bigching_pic/大腸.jpg'),
(25, 25, '粉腸', 40, '上等肉類', 1, 'bigching_pic/粉腸.jpg'),
(26, 26, '豬頭皮', 30, '上等肉類', 1, 'bigching_pic/豬頭皮.jpg'),
(27, 27, '豬耳朵', 30, '上等肉類', 1, 'bigching_pic/豬耳朵.jpg'),
(28, 28, '豬舌頭', 30, '上等肉類', 1, 'bigching_pic/豬舌頭.jpg'),
(29, 29, '鴨胗', 20, '上等肉類', 1, 'bigching_pic/鴨胗.jpg'),
(30, 30, '豬皮', 15, '上等肉類', 1, 'bigching_pic/豬皮.jpg'),
(31, 31, '鴨心', 20, '上等肉類', 1, 'bigching_pic/鴨心.jpg'),
(32, 32, '手工大黑豆干', 25, '豆品類', 1, 'bigching_pic/手工大黑豆干.jpg'),
(33, 33, '五香豆干', 15, '豆品類', 1, 'bigching_pic/五香豆干.jpg'),
(34, 34, '手工蘭花干', 25, '豆品類', 1, 'bigching_pic/手工蘭花干.jpg'),
(35, 35, '手工豆包', 10, '豆品類', 1, 'bigching_pic/手工豆包.jpg'),
(36, 36, '手工百頁豆腐', 15, '豆品類', 1, 'bigching_pic/手工百頁豆腐.jpg'),
(37, 37, '上等大油皮', 20, '豆品類', 1, 'bigching_pic/上等大油皮.jpg'),
(38, 38, '菜頭', 10, '其他類', 1, 'bigching_pic/菜頭.jpg'),
(39, 39, '手工大蝦捲', 25, '其他類', 1, 'bigching_pic/手工大蝦捲.jpg'),
(40, 40, '大熱狗', 25, '其他類', 1, 'bigching_pic/大熱狗.jpg'),
(41, 41, '德國香腸', 25, '其他類', 1, 'bigching_pic/德國香腸.jpg'),
(42, 42, '日式玉子燒', 25, '其他類', 1, 'bigching_pic/日式玉子燒.jpg'),
(43, 43, '麻辣鴨血臭豆腐', 25, '其他類', 1, 'bigching_pic/麻辣鴨血臭豆腐.jpg'),
(44, 44, '狀元米腸', 20, '其他類', 1, 'bigching_pic/狀元米腸.jpg'),
(45, 45, '手工牛母', 25, '其他類', 1, 'bigching_pic/手工牛母.jpg'),
(46, 46, '手工甜不辣', 15, '其他類', 1, 'bigching_pic/手工甜不辣.jpg'),
(47, 47, '海帶卷', 10, '其他類', 1, 'bigching_pic/海帶卷.jpg'),
(48, 48, '小熱狗', 15, '其他類', 1, 'bigching_pic/小熱狗.jpg'),
(49, 49, '手工黑輪', 15, '其他類', 1, 'bigching_pic/手工黑輪.jpg'),
(50, 50, '雪魚燒', 15, '其他類', 1, 'bigching_pic/雪魚燒.jpg'),
(51, 51, '日式竹輪', 10, '其他類', 1, 'bigching_pic/日式竹輪.jpg'),
(52, 52, '黃金豆腐', 15, '其他類', 1, 'bigching_pic/黃金豆腐.jpg'),
(53, 53, '手工鴨米血', 15, '其他類', 1, 'bigching_pic/手工鴨米血.jpg'),
(54, 54, '麻辣鴨血', 15, '其他類', 1, 'bigching_pic/麻辣鴨血.jpg'),
(55, 55, '凍豆腐', 10, '其他類', 1, 'bigching_pic/凍豆腐.jpg'),
(56, 56, '滷蛋', 15, '其他類', 1, 'bigching_pic/滷蛋.jpg'),
(57, 57, '麻辣臭豆腐', 10, '其他類', 1, 'bigching_pic/麻辣臭豆腐.jpg'),
(58, 58, '油條', 15, '其他類', 1, 'bigching_pic/油條.jpg'),
(59, 59, '手工水晶餃', 15, '其他類', 1, 'bigching_pic/手工水晶餃.jpg'),
(60, 60, '雪魚丸', 5, '火鍋料類', 1, 'bigching_pic/雪魚丸.jpg'),
(61, 61, '魚餃', 5, '火鍋料類', 1, 'bigching_pic/魚餃.jpg'),
(62, 62, '燕餃', 5, '火鍋料類', 1, 'bigching_pic/燕餃.jpg'),
(63, 63, '鴨肉丸', 5, '火鍋料類', 1, 'bigching_pic/鴨肉丸.jpg'),
(64, 64, '小蝦球', 5, '火鍋料類', 1, 'bigching_pic/小蝦球.jpg'),
(65, 65, '魚卵卷', 5, '火鍋料類', 1, 'bigching_pic/魚卵卷.jpg'),
(66, 66, '龍蝦沙拉', 15, '火鍋料類', 1, 'bigching_pic/龍蝦沙拉.jpg'),
(67, 67, '魚包蛋', 15, '火鍋料類', 1, 'bigching_pic/魚包蛋.jpg'),
(68, 68, '爆濃起司球', 15, '火鍋料類', 1, 'bigching_pic/爆濃起司球.jpg'),
(69, 69, '麻吉燒（芝麻）', 15, '火鍋料類', 1, 'bigching_pic/麻吉燒（芝麻）.jpg'),
(70, 70, '麻吉燒（花生）', 15, '火鍋料類', 1, 'bigching_pic/麻吉燒（花生）.jpg'),
(71, 71, '新竹大貢丸', 15, '火鍋料類', 1, 'bigching_pic/新竹大貢丸.jpg'),
(72, 72, '蟹肉棒', 15, '火鍋料類', 1, 'bigching_pic/蟹肉棒.jpg'),
(73, 73, '起司魚豆腐', 15, '火鍋料類', 1, 'bigching_pic/起司魚豆腐.jpg'),
(74, 74, '鑫鑫腸', 5, '火鍋料類', 1, 'bigching_pic/鑫鑫腸.jpg'),
(75, 75, '韓國年糕', 5, '火鍋料類', 1, 'bigching_pic/韓國年糕.jpg'),
(76, 76, '烏蛋', 5, '火鍋料類', 1, 'bigching_pic/烏蛋.jpg'),
(77, 77, '章魚球', 15, '火鍋料類', 1, 'bigching_pic/章魚球.jpg'),
(78, 78, '花椰菜', 30, '蔬菜類', 1, 'bigching_pic/花椰菜.jpg'),
(79, 79, '水蓮', 25, '蔬菜類', 1, 'bigching_pic/水蓮.jpg'),
(80, 80, '高麗菜', 20, '蔬菜類', 1, 'bigching_pic/高麗菜.jpg'),
(81, 81, '地瓜葉', 20, '蔬菜類', 1, 'bigching_pic/地瓜葉.jpg'),
(82, 82, '空心菜', 20, '蔬菜類', 1, 'bigching_pic/空心菜.jpg'),
(83, 83, '娃娃菜', 20, '蔬菜類', 1, 'bigching_pic/娃娃菜.jpg'),
(84, 84, '大陸妹', 20, '蔬菜類', 1, 'bigching_pic/大陸妹.jpg'),
(85, 85, '洋蔥', 20, '蔬菜類', 1, 'bigching_pic/洋蔥.jpg'),
(86, 86, '南瓜', 20, '蔬菜類', 1, 'bigching_pic/南瓜.jpg'),
(87, 87, '山苦瓜', 20, '蔬菜類', 1, 'bigching_pic/山苦瓜.jpg'),
(88, 88, '青椒', 20, '蔬菜類', 1, 'bigching_pic/青椒.jpg'),
(89, 89, '四季豆', 20, '蔬菜類', 1, 'bigching_pic/四季豆.jpg'),
(90, 90, '豆芽菜', 20, '蔬菜類', 1, 'bigching_pic/豆芽菜.jpg'),
(91, 91, '玉米筍', 20, '蔬菜類', 1, 'bigching_pic/玉米筍.jpg'),
(92, 92, '極品香菇', 20, '香菇類', 1, 'bigching_pic/極品香菇.jpg'),
(93, 93, '秀針菇', 20, '香菇類', 1, 'bigching_pic/秀針菇.jpg'),
(94, 94, '杏鮑菇', 20, '香菇類', 1, 'bigching_pic/杏鮑菇.jpg'),
(95, 95, '特選黑木耳', 20, '香菇類', 1, 'bigching_pic/特選黑木耳.jpg'),
(96, 96, '金針菇', 20, '香菇類', 1, 'bigching_pic/金針菇.jpg'),
(97, 97, '菠菜', 20, '冬季蔬菜類', 1, 'bigching_pic/菠菜.jpg'),
(98, 98, '茼蒿', 20, '冬季蔬菜類', 1, 'bigching_pic/茼蒿.jpg'),
(99, 99, '山茼蒿', 20, '冬季蔬菜類', 1, 'bigching_pic/山茼蒿.jpg');

-- --------------------------------------------------------

--
-- 資料表結構 `order`
--

CREATE TABLE `order` (
  `Order_ID` int(11) NOT NULL COMMENT '訂單 ID',
  `Customer_ID` int(11) DEFAULT NULL COMMENT '顧客 ID (外鍵)',
  `Order_Date` datetime DEFAULT NULL COMMENT '訂購日期',
  `Order_exit` tinyint(4) DEFAULT NULL COMMENT '訂單是否已完成 (0=否, 1=是)',
  `Pickup_Code` varchar(10) DEFAULT NULL COMMENT '取餐編號',
  `Order_Remark` text DEFAULT NULL COMMENT '訂單備註，包含辣度、口味、作法及配料等自定義選項'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `order`
--

INSERT INTO `order` (`Order_ID`, `Customer_ID`, `Order_Date`, `Order_exit`, `Pickup_Code`, `Order_Remark`) VALUES
(9, 13, '2025-05-30 18:47:41', 1, '1', '辣度: 無, 口味: 重, 作法: 全湯, 蔥: 不加蔥, 酸菜: 不加酸菜'),
(10, 6, '2025-05-22 18:56:09', 0, '699517', '辣度: 中辣, 口味: 重, 作法: 全湯, 蔥: 不加蔥, 酸菜: 不加'),
(11, 13, '2025-05-18 18:56:09', 0, '899605', '辣度: 再微辣, 口味: 清淡, 作法: 包湯, 蔥: 不加蔥, 酸菜: 多加'),
(12, 6, '2025-05-23 18:56:09', 0, '644463', '辣度: 小辣, 口味: 清淡, 作法: 半湯, 蔥: 不加蔥, 酸菜: 多加'),
(13, 13, '2025-05-25 18:56:09', 0, '355502', '辣度: 再微辣, 口味: 重, 作法: 半湯, 蔥: 多蔥, 酸菜: 多加'),
(14, 3, '2025-05-27 18:56:09', 0, '002887', '辣度: 中辣, 口味: 重, 作法: 包湯, 蔥: 多蔥, 酸菜: 不加'),
(15, 4, '2025-05-06 18:56:09', 0, '982147', '辣度: 微辣, 口味: 重, 作法: 半湯, 蔥: 多蔥, 酸菜: 多加'),
(16, 8, '2025-05-11 18:56:09', 0, '441386', '辣度: 再微辣, 口味: 豚骨, 作法: 包湯, 蔥: 不加蔥, 酸菜: 不加'),
(17, 1, '2025-05-12 18:56:09', 0, '338427', '辣度: 包辣, 口味: 清淡, 作法: 乾, 蔥: 多蔥, 酸菜: 多加'),
(18, 4, '2025-05-17 18:56:09', 0, '074202', '辣度: 無, 口味: 重, 作法: 乾, 蔥: 不加蔥, 酸菜: 多加'),
(19, 11, '2025-05-06 18:56:09', 0, '170730', '辣度: 微辣, 口味: 不加醬, 作法: 半湯, 蔥: 不加蔥, 酸菜: 不加'),
(20, 9, '2025-05-05 18:56:09', 0, '411360', '辣度: 小辣, 口味: 清淡, 作法: 全湯, 蔥: 不加蔥, 酸菜: 多加'),
(21, 1, '2025-05-07 18:56:09', 0, '867981', '辣度: 無, 口味: 不加醬, 作法: 乾, 蔥: 不加蔥, 酸菜: 多加'),
(22, 9, '2025-05-16 18:56:09', 0, '436137', '辣度: 中辣, 口味: 清淡, 作法: 乾, 蔥: 不加蔥, 酸菜: 多加'),
(23, 5, '2025-05-20 18:56:09', 0, '304152', '辣度: 小辣, 口味: 不加醬, 作法: 全湯, 蔥: 不加蔥, 酸菜: 不加'),
(24, 13, '2025-05-11 18:56:09', 0, '121568', '辣度: 中辣, 口味: 麻辣, 作法: 全湯, 蔥: 多蔥, 酸菜: 多加'),
(25, 4, '2025-05-10 18:56:09', 0, '781179', '辣度: 包辣, 口味: 重, 作法: 包湯, 蔥: 多蔥, 酸菜: 多加'),
(26, 7, '2025-05-24 18:56:09', 0, '843473', '辣度: 小辣, 口味: 重, 作法: 包湯, 蔥: 不加蔥, 酸菜: 多加'),
(27, 9, '2025-05-18 18:56:09', 0, '291238', '辣度: 再微辣, 口味: 豚骨, 作法: 半湯, 蔥: 多蔥, 酸菜: 多加'),
(28, 8, '2025-05-18 18:56:09', 0, '380816', '辣度: 中辣, 口味: 清淡, 作法: 全湯, 蔥: 多蔥, 酸菜: 多加'),
(29, 11, '2025-05-08 18:56:09', 0, '023008', '辣度: 包辣, 口味: 清淡, 作法: 乾, 蔥: 不加蔥, 酸菜: 不加');

-- --------------------------------------------------------

--
-- 資料表結構 `order_item`
--

CREATE TABLE `order_item` (
  `Item_ID` int(11) NOT NULL COMMENT '訂單項目 ID',
  `Menu_ID` int(11) NOT NULL COMMENT '菜單品項 ID (外鍵)',
  `Order_ID` int(11) DEFAULT NULL COMMENT '訂單 ID (外鍵)',
  `quantity` int(11) DEFAULT NULL COMMENT '數量',
  `unit_price` int(11) DEFAULT NULL COMMENT '單價'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `order_item`
--

INSERT INTO `order_item` (`Item_ID`, `Menu_ID`, `Order_ID`, `quantity`, `unit_price`) VALUES
(18, 61, 9, 1, 5),
(19, 60, 9, 1, 5),
(20, 2, 9, 1, 150),
(21, 18, 10, 1, 15),
(22, 48, 11, 4, 15),
(23, 62, 12, 3, 5),
(24, 15, 12, 1, 20),
(25, 29, 12, 3, 20),
(26, 5, 13, 3, 120),
(27, 32, 14, 1, 25),
(28, 23, 14, 5, 40),
(29, 37, 14, 1, 20),
(30, 98, 15, 5, 20),
(31, 12, 16, 3, 15),
(32, 80, 17, 5, 20),
(33, 86, 17, 4, 20),
(34, 66, 17, 4, 15),
(35, 93, 18, 4, 20),
(36, 60, 18, 5, 5),
(37, 25, 18, 5, 40),
(38, 46, 19, 3, 15),
(39, 85, 19, 4, 20),
(40, 87, 20, 1, 20),
(41, 17, 21, 1, 15),
(42, 79, 21, 4, 25),
(43, 56, 22, 2, 15),
(44, 78, 23, 1, 30),
(45, 2, 23, 4, 150),
(46, 31, 24, 5, 20),
(47, 14, 24, 5, 20),
(48, 73, 24, 1, 15),
(49, 92, 25, 3, 20),
(50, 59, 25, 1, 15),
(51, 93, 25, 5, 20),
(52, 29, 26, 5, 20),
(53, 90, 26, 5, 20),
(54, 22, 27, 4, 30),
(55, 96, 28, 4, 20),
(56, 24, 28, 4, 40),
(57, 58, 29, 2, 15);

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `Product_ID` int(11) NOT NULL,
  `cost_price` int(11) DEFAULT NULL COMMENT '成本價格',
  `Ingredient_ID` int(11) DEFAULT NULL COMMENT '食材 ID (外鍵)',
  `HotPot_ID` int(11) DEFAULT NULL COMMENT '火鍋類型 ID (外鍵)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`Product_ID`, `cost_price`, `Ingredient_ID`, `HotPot_ID`) VALUES
(1, 115, NULL, 1),
(2, 145, NULL, 2),
(3, 145, NULL, 3),
(4, 115, NULL, 4),
(5, 115, NULL, 5),
(6, 115, NULL, 6),
(7, 95, NULL, 7),
(8, 30, 1, NULL),
(9, 20, 2, NULL),
(10, 15, 3, NULL),
(11, 20, 4, NULL),
(12, 10, 5, NULL),
(13, 15, 6, NULL),
(14, 15, 7, NULL),
(15, 15, 8, NULL),
(16, 15, 9, NULL),
(17, 10, 10, NULL),
(18, 10, 11, NULL),
(19, 30, 12, NULL),
(20, 30, 13, NULL),
(21, 25, 14, NULL),
(22, 25, 15, NULL),
(23, 35, 16, NULL),
(24, 35, 17, NULL),
(25, 35, 18, NULL),
(26, 25, 19, NULL),
(27, 25, 20, NULL),
(28, 25, 21, NULL),
(29, 15, 22, NULL),
(30, 10, 23, NULL),
(31, 15, 24, NULL),
(32, 20, 25, NULL),
(33, 10, 26, NULL),
(34, 20, 27, NULL),
(35, 5, 28, NULL),
(36, 10, 29, NULL),
(37, 15, 30, NULL),
(38, 5, 31, NULL),
(39, 20, 32, NULL),
(40, 20, 33, NULL),
(41, 20, 34, NULL),
(42, 20, 35, NULL),
(43, 20, 36, NULL),
(44, 15, 37, NULL),
(45, 20, 38, NULL),
(46, 10, 39, NULL),
(47, 5, 40, NULL),
(48, 10, 41, NULL),
(49, 10, 42, NULL),
(50, 10, 43, NULL),
(51, 5, 44, NULL),
(52, 10, 45, NULL),
(53, 10, 46, NULL),
(54, 10, 47, NULL),
(55, 5, 48, NULL),
(56, 10, 49, NULL),
(57, 5, 50, NULL),
(58, 10, 51, NULL),
(59, 10, 52, NULL),
(60, 5, 53, NULL),
(61, 5, 54, NULL),
(62, 5, 55, NULL),
(63, 5, 56, NULL),
(64, 5, 57, NULL),
(65, 5, 58, NULL),
(66, 10, 59, NULL),
(67, 10, 60, NULL),
(68, 10, 61, NULL),
(69, 10, 62, NULL),
(70, 10, 63, NULL),
(71, 10, 64, NULL),
(72, 10, 65, NULL),
(73, 10, 66, NULL),
(74, 5, 67, NULL),
(75, 5, 68, NULL),
(76, 5, 69, NULL),
(77, 10, 70, NULL),
(78, 25, 71, NULL),
(79, 20, 72, NULL),
(80, 15, 73, NULL),
(81, 15, 74, NULL),
(82, 15, 75, NULL),
(83, 15, 76, NULL),
(84, 15, 77, NULL),
(85, 15, 78, NULL),
(86, 15, 79, NULL),
(87, 15, 80, NULL),
(88, 15, 81, NULL),
(89, 15, 82, NULL),
(90, 15, 83, NULL),
(91, 15, 84, NULL),
(92, 15, 85, NULL),
(93, 15, 86, NULL),
(94, 15, 87, NULL),
(95, 15, 88, NULL),
(96, 15, 89, NULL),
(97, 15, 90, NULL),
(98, 15, 91, NULL),
(99, 15, 92, NULL);

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
  ADD PRIMARY KEY (`Item_ID`,`Menu_ID`) USING BTREE,
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
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `customer`
--
ALTER TABLE `customer`
  MODIFY `Customer_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '顧客 ID', AUTO_INCREMENT=15;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `Ingredient_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `menu`
--
ALTER TABLE `menu`
  MODIFY `Menu_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order`
--
ALTER TABLE `order`
  MODIFY `Order_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '訂單 ID', AUTO_INCREMENT=30;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order_item`
--
ALTER TABLE `order_item`
  MODIFY `Item_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '訂單項目 ID', AUTO_INCREMENT=58;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `Product_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

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
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`Order_ID`) REFERENCES `order` (`Order_ID`) ON DELETE CASCADE;

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
