-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016 �?06 �?22 �?16:47
-- 服务器版本: 5.5.40
-- PHP 版本: 5.5.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `lut`
--

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(64) DEFAULT NULL,
  `mobile` varchar(64) DEFAULT NULL,
  `accessToken` varchar(64) NOT NULL DEFAULT 'accessToken',
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` int(11) DEFAULT NULL,
  `expire` int(11) NOT NULL DEFAULT '0',
  `nickName` varchar(128) DEFAULT NULL,
  `trueName` varchar(128) DEFAULT NULL,
  `birthday` varchar(128) DEFAULT NULL,
  `gender` varchar(128) DEFAULT NULL,
  `signer` varchar(128) DEFAULT NULL,
  `zone` varchar(128) DEFAULT NULL,
  `addr` varchar(128) DEFAULT NULL,
  `gravatar` varchar(128) DEFAULT NULL,
  `height` varchar(16) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  `des` varchar(128) DEFAULT NULL,
  `select` varchar(20) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`userId`, `login`, `password`, `email`, `mobile`, `accessToken`, `createAt`, `updateAt`, `expire`, `nickName`, `trueName`, `birthday`, `gender`, `signer`, `zone`, `addr`, `gravatar`, `height`, `active`, `sort`, `des`, `select`) VALUES
(1, '1ew234', '12345678', NULL, '13673764379', 'accessToken', NULL, 1458702747, 0, 'wwwww', '4324', '2014-01-10', '女', '0', '0', NULL, 'http://api.so/U/v/201603/11/0a05b10f77d53c0a6cd36068a19da630.txt', '30cm', 1, 0, '123', ''),
(2, '13673764379', '25F9E794323B453885F5181F1B624D0B', NULL, '13673764379', 'accessToken', '2016-04-14 02:47:54', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'http://api.guangjuli.net/U/v/201605/06/049c6cb66adff88f9a2fc308ae72b37f.png', NULL, 0, 0, NULL, ''),
(3, '13552099798', 'E10ADC3949BA59ABBE56E057F20F883E', NULL, '13552099798', 'accessToken', '2016-05-05 01:15:13', 1462497474, 0, 'look', NULL, '1900年-01月-01日', '男', NULL, NULL, NULL, NULL, '身高', 0, 0, NULL, ''),
(5, 'irones', '12345678', 'shampeak@sina.com', '13811069199', 'accessToken', '2016-06-08 07:08:33', NULL, 0, 'x7x658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(6, 'irones', '12345678', 'shampeak@sina.com', '13811069199', 'accessToken', '2016-06-08 07:09:53', NULL, 0, 'x7x658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(13, 'irones', '12345678', 'shampeak@sina.com', '13811069199', 'accessToken', '2016-06-08 07:15:37', NULL, 0, 'x7x658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(14, 'irones', '12345678', 'shampeak@sina.com', '13811069199', 'accessToken', '2016-06-08 07:16:09', NULL, 0, 'x7x658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(15, 'irones', '12345678', 'shampeak@sina.com', '13811069199', 'accessToken', '2016-06-08 07:17:14', NULL, 0, 'x7x658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(16, 'irones', '12345678', 'shampeak@sina.com', '13811069199', 'accessToken', '2016-06-08 07:17:51', NULL, 0, 'x7x658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(17, 'irones', '12345678', 'shampeak@sina.com', '13811069199', 'accessToken', '2016-06-08 07:51:03', NULL, 0, 'x7x658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(18, 'irones', '12345678', 'shampeak@sina.com', '13811069199', 'accessToken', '2016-06-08 07:51:30', NULL, 0, 'x7x658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(19, 'irones', '12345678', 'shampeak@sina.com', '13811069199', 'accessToken', '2016-06-08 07:52:05', NULL, 0, 'x7x658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(20, 'irones', '12345678', 'shampeak@sina.com', '13811069199', 'accessToken', '2016-06-08 07:52:20', NULL, 0, 'x7x658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(21, 'irones', '12345678', 'shampeak@sina.com', '13811069199', 'accessToken', '2016-06-08 07:52:58', NULL, 0, 'x7x658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(22, 'irones', '12345678', 'shampeak@sina.com', '13811069199', 'accessToken', '2016-06-08 07:54:06', NULL, 0, 'x7x658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(23, 'irones', '12345678', 'shampeak@sina.com', '13811069199', 'accessToken', '2016-06-08 07:54:07', NULL, 0, 'x7x658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(24, 'irones', '12345678', 'shampeak@sina.com', '13811069199', 'accessToken', '2016-06-08 07:54:12', NULL, 0, 'x7x658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(25, 'irones', '12345678', 'shampeak@sina.com', '13811069199', 'accessToken', '2016-06-08 07:54:23', NULL, 0, 'x7x658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(26, 'irones', '12345678', 'shampeak@sina.com', '13811069199', 'accessToken', '2016-06-08 07:54:24', NULL, 0, 'x7x658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(27, 'irones', '12345678', 'shampeak@sina.com', '13811069199', 'accessToken', '2016-06-08 07:58:00', NULL, 0, 'x7x658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(28, 'irones', '12345678', 'shampeak@sina.com', '13811069199', 'accessToken', '2016-06-08 08:02:35', NULL, 0, 'x7x658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(29, 'irones', '12345678', 'shampeak@sina.com', '13811069199', 'accessToken', '2016-06-08 09:19:55', NULL, 0, 'x7x658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(30, 'irones', '12345678', 'shampeak@sina.com', '13811069199', 'accessToken', '2016-06-08 09:24:21', NULL, 0, 'x7x658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(31, 'irones', '12345678', 'shampeak@sina.com', '13811069199', 'accessToken', '2016-06-10 02:48:34', NULL, 0, 'x7x658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(32, 'irones', '12345678', 'shampeak@sina.com', '13811069199', 'accessToken', '2016-06-10 03:09:22', NULL, 0, 'x7x658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(33, 'irones', '12345678', 'shampeak@sina.com', '13811069199', 'accessToken', '2016-06-10 03:10:19', NULL, 0, 'x7x658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(34, 'irones', '12345678', 'shampeak@sina.com', '13811069199', 'accessToken', '2016-06-10 03:12:24', NULL, 0, 'x7x658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(35, 'irones', '12345678', 'shampeak@sina.com', '13811069199', 'accessToken', '2016-06-10 03:13:50', NULL, 0, 'x7x658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(36, 'irones', '12345678', 'shampeak@sina.com', '13811069199', 'accessToken', '2016-06-10 03:15:12', NULL, 0, 'x7x658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(37, '1234', '2', 'shampeak@sina.com', '13811069199', 'accessToken', '2016-06-10 03:17:32', NULL, 0, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(38, '1234', '12345678', 'shampeak@sina.com', '13811069199', 'accessToken', '2016-06-10 03:34:32', NULL, 0, 'dwewr', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '1ew234'),
(39, '', '12345678', 'shampeak@sina.com', '13811069199', 'accessToken', '2016-06-10 03:41:17', NULL, 0, 'x7x658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'select'),
(40, '', '12345678', 'shampeak@sina.com', '13811069199', 'accessToken', '2016-06-10 03:45:04', NULL, 0, 'x7x658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'select'),
(41, 'select', '12345678', 'shampeak@sina.com', '13811069199', 'accessToken', '2016-06-10 13:40:16', NULL, 0, 'x7x658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(42, 'select', '12345678', 'sha"m"peak@sina.com', '13811069199', 'accessToken', '2016-06-22 01:58:50', NULL, 0, 'x7x\\658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(43, 'select', '12345678', 'sha"m"peak@sina.com', '13811069199', 'accessToken', '2016-06-22 02:21:21', NULL, 0, 'x7x\\658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(44, 'select', '12345678', 'sha"m"peak@sina.com', '13811069199', 'accessToken', '2016-06-22 02:21:44', NULL, 0, 'x7x\\658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(45, 'select', '12345678', 'sha"m"peak@sina.com', '13811069199', 'accessToken', '2016-06-22 02:22:06', NULL, 0, 'x7x\\658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(46, 'select', '12345678', 'sha"m"peak@sina.com', '13811069199', 'accessToken', '2016-06-22 02:47:57', NULL, 0, 'x7x\\658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(47, 'select', '12345678', 'sha"m"peak@sina.com', '13811069199', 'accessToken', '2016-06-22 02:49:04', NULL, 0, 'x7x\\658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(48, 'select', '12345678', 'sha"m"peak@sina.com', '13811069199', 'accessToken', '2016-06-22 02:50:27', NULL, 0, 'x7x\\658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(49, 'select', '12345678', 'sha"m"peak@sina.com', '13811069199', 'accessToken', '2016-06-22 02:55:26', NULL, 0, 'x7x\\658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(50, 'select', '12345678', 'sha"m"peak@sina.com', '13811069199', 'accessToken', '2016-06-22 06:48:16', NULL, 0, 'x7x\\658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(51, 'select', '12345678', 'sha"m"peak@sina.com', '13811069199', 'accessToken', '2016-06-22 06:48:49', NULL, 0, 'x7x\\658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(52, 'select', '12345678', 'sha"m"peak@sina.com', '13811069199', 'accessToken', '2016-06-22 06:49:35', NULL, 0, 'x7x\\658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(53, 'select', '12345678', 'sha"m"peak@sina.com', '13811069199', 'accessToken', '2016-06-22 06:55:03', NULL, 0, 'x7x\\658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(54, 'select', '12345678', 'sha"m"peak@sina.com', '13811069199', 'accessToken', '2016-06-22 06:56:10', NULL, 0, 'x7x\\658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(55, 'select', '12345678', 'sha"m"peak@sina.com', '13811069199', 'accessToken', '2016-06-22 07:03:55', NULL, 0, 'x7x\\658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(56, 'select', '12345678', 'sha"m"peak@sina.com', '13811069199', 'accessToken', '2016-06-22 07:12:32', NULL, 0, 'x7x\\658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(57, 'select', '12345678', 'sha"m"peak@sina.com', '13811069199', 'accessToken', '2016-06-22 07:13:18', NULL, 0, 'x7x\\658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(58, 'select', '12345678', 'sha"m"peak@sina.com', '13811069199', 'accessToken', '2016-06-22 07:14:22', NULL, 0, 'x7x\\658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(59, 'select', '12345678', 'sha"m"peak@sina.com', '13811069199', 'accessToken', '2016-06-22 07:15:03', NULL, 0, 'x7x\\658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, ''),
(60, 'select', '12345678', 'sha"m"peak@sina.com', '13811069199', 'accessToken', '2016-06-22 07:16:07', NULL, 0, 'x7x\\658', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
