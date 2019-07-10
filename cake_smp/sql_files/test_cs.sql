-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- ホスト: 127.0.0.1
-- 生成日時: 2014 年 4 月 25 日 08:56
-- サーバのバージョン: 5.5.32
-- PHP のバージョン: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- データベース: `cake_smp`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `test_cs`
--

CREATE TABLE IF NOT EXISTS `test_cs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `anim_id` int(11) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `anim_name` varchar(50) CHARACTER SET utf32 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- テーブルのデータのダンプ `test_cs`
--

INSERT INTO `test_cs` (`id`, `anim_id`, `shop_id`, `anim_name`) VALUES
(1, 1, 1, 'ネコ'),
(2, 1, 2, 'ネズミ'),
(3, 1, 4, 'トラ'),
(4, 2, 1, '鵜'),
(5, 2, 2, 'サル'),
(6, 3, 1, 'ニンジン'),
(7, 3, 2, 'カニ'),
(8, 3, 3, 'ブタ');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
