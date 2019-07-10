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
-- テーブルの構造 `test_as`
--

CREATE TABLE IF NOT EXISTS `test_as` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `val1` int(11) DEFAULT NULL,
  `text1` varchar(50) DEFAULT NULL,
  `test_date` date DEFAULT NULL,
  `test_dt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- テーブルのデータのダンプ `test_as`
--

INSERT INTO `test_as` (`id`, `val1`, `text1`, `test_date`, `test_dt`) VALUES
(1, 1, 'neko', '2014-04-01', '2014-12-12 00:00:00'),
(2, 2, 'kani', '2014-04-02', '2014-12-12 00:00:01'),
(4, 4, 'buta', '2014-04-04', '2014-12-12 00:00:03'),
(5, 3, 'yagi', '2014-04-03', '2014-12-12 00:00:02'),
(6, 3, 'ari', '2014-04-03', '2014-12-12 00:00:02'),
(7, 3, 'tori', '2014-04-03', '2014-12-12 00:00:02'),
(8, 3, 'kame', '2014-04-03', '2014-12-12 00:00:02');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
