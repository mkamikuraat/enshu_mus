-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2024-06-19 10:19:39
-- サーバのバージョン： 10.4.32-MariaDB
-- PHP のバージョン: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `mus`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `time` datetime DEFAULT current_timestamp(),
  `title` varchar(255) NOT NULL,
  `dob_s` varchar(255) NOT NULL,
  `dob_e` varchar(255) NOT NULL,
  `space` int(11) NOT NULL,
  `text` text NOT NULL,
  `editname` varchar(100) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- テーブルのデータのダンプ `event`
--

INSERT INTO `event` (`id`, `time`, `title`, `dob_s`, `dob_e`, `space`, `text`, `editname`, `dob`, `flag`) VALUES
(1, '2024-06-10 14:36:30', 'test', 'y', 'd', 0, '', '', '', 1),
(2, '2024-06-11 10:11:22', '神倉美術館創立記念展', '2024-06-19', '2024-06-30', 0, '', '', '', 1),
(3, '2024-06-17 09:46:08', '傲慢', '2024-06-29', '2024-07-06', 3, '解説：傲慢と偏見\r\n\r\n威張ってばっかり\r\n頭も固い\r\nだから、会話が成り立たない。\r\n', '七つの大罪', '2024-06-20', 0),
(4, '2024-06-17 09:48:35', '嫉妬', '2024-08-28', '2024-09-13', 2, '解説：嫉妬と憂鬱', '七つの大罪', '2024-06-20', 0),
(5, '2024-06-17 09:49:39', '憤怒', '2024-11-14', '2024-11-29', 1, '解説：怒りと敵', '七つの大罪', '2024-06-20', 0),
(6, '2024-06-17 09:50:35', '強欲', '2024-12-26', '2024-06-29', 2, '強欲と金銭', '七つの大罪', '2024-06-20', 1),
(7, '2024-06-17 09:51:50', '怠惰', '2024-08-07', '2024-09-30', 1, '怠惰と適当', '七つの大罪', '2024-06-20', 0),
(8, '2024-06-17 09:53:00', '暴食', '2025-01-10', '2025-01-31', 2, '暴食とストレス', '七つの大罪', '2024-06-20', 0),
(9, '2024-06-17 09:53:54', '色欲', '2024-07-26', '2024-08-01', 3, '色欲と生存', '七つの大罪', '2024-06-20', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `eventtype` int(11) NOT NULL,
  `dob_c` varchar(100) NOT NULL,
  `time` int(11) NOT NULL,
  `tickettype` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` int(11) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `address` int(11) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- テーブルのデータのダンプ `ticket`
--

INSERT INTO `ticket` (`id`, `username`, `password`, `eventtype`, `dob_c`, `time`, `tickettype`, `name`, `gender`, `dob`, `address`, `flag`) VALUES
(1, '', '', 1, '2024-06-16', 1, 1, 'テスト', 1, '1900-00-00', 1, 0),
(2, '', '', 2, '2024-07-08', 2, 2, '時間娘', 3, '2024-06-15', 1, 0),
(3, '', '', 1, '2024-07-11', 5, 4, 'son', 1, '', 0, 0),
(4, 'aa1', 'aaaaa', 5, '2024-09-11', 7, 2, 'あいうえお', 2, '2024-06-18', 3, 0),
(5, 'kanda', 'kkk', 4, '2024-09-11', 2, 1, 'あいうえお', 2, '2024-06-01', 1, 0),
(6, '', '', 5, '2024-07-26', 2, 3, '偉いのです', 1, '2022-02-09', 2, 0),
(7, '', '', 2, '2024-07-18', 2, 2, '画面', 2, '2024-06-01', 1, 0),
(8, '0', '0', 5, '2024-09-19', 7, 1, '時間', 1, '2024-06-26', 3, 0),
(9, '0', '0', 5, '2024-09-19', 7, 1, '時間', 1, '2024-06-26', 3, 0),
(10, '0', '0', 5, '2024-09-19', 7, 1, '時間', 1, '2024-06-26', 3, 0),
(11, '0', '1234', 4, '2024-06-29', 3, 3, '香川', 2, '2024-06-03', 2, 0),
(12, '0', '1234', 4, '2024-06-29', 3, 3, '香川', 2, '2024-06-03', 2, 0),
(13, '0', '1234', 4, '2024-06-29', 3, 3, '香川', 2, '2024-06-03', 2, 0),
(14, '0', '1234', 4, '2024-06-28', 1, 3, '香川偉い人', 3, '1987-03-12', 1, 1),
(15, '0', '0', 1, '2024-07-01', 1, 1, 'dddd', 2, '2024-06-02', 2, 0),
(16, '0', '0', 1, '2024-07-01', 1, 1, 'dddd', 2, '2024-05-26', 1, 0),
(17, 'time', 'time', 4, '2024-10-23', 3, 1, 'a', 2, '2024-05-27', 1, 0),
(18, 'time', 'time', 2, '2024-07-16', 6, 2, 'aaa', 2, '2024-05-05', 1, 0),
(19, '香', '1234', 2, '2024-07-23', 4, 2, 'kagawa', 3, '2024-07-04', 1, 1),
(20, '香川', '1234', 1, '2024-07-07', 4, 1, '変わる', 3, '2024-06-14', 2, 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` text NOT NULL,
  `dob` date NOT NULL,
  `address` text NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- テーブルのデータのダンプ `user`
--

INSERT INTO `user` (`userid`, `username`, `mail`, `password`, `name`, `gender`, `dob`, `address`, `flag`) VALUES
(1, 'test', 'mus@athome.co.jp', 'aaa', 'a', '0', '2001-07-31', '0', 0),
(2, 'test', 'mus@athome.co.jp', 'aaa', 'a', '0', '2001-07-31', '0', 0),
(3, 'karakara', 'mk@athome.co,jp', 'zzz', '人', 'male', '2024-06-10', 'male', 0),
(4, 'admin', 'kaka@athome.co.jp', 'password', '管理者', 'male', '2024-06-06', 'male', 1),
(5, 'ngo', 'ngo@ngo.com', 'ngo', 'ngo', 'male', '2024-06-01', 'female', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `address` int(11) NOT NULL,
  `terms` varchar(100) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 0,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `username`, `mail`, `password`, `name`, `gender`, `dob`, `address`, `terms`, `flag`, `is_admin`) VALUES
(1, 'user', 'test@test.test', 'aaa', 'テスト', 1, '2000-00-00', 1, '同意しました', 0, 1),
(2, 'time', 'time@time.time', 'time', '時の番人', 2, '2024-06-26', 2, '同意しました', 1, 0),
(4, 'ファミリーマート', 'family@fam.com', 'fff', 'ファミマ', 3, '', 1, 'on', 0, 0),
(5, 'ファミリーマート', 'family@fam.com', 'fff', 'ファミマ', 3, '', 1, 'on', 1, 0),
(6, 'ファミリーマート', 'family@fam.com', 'mmm', 'ファミマ', 3, '', 2, 'on', 1, 0),
(7, 'ファミリーマート', 'family@fam.com', 'mmm', 'ファミマ', 3, '', 2, 'on', 1, 0),
(8, 'ファミリーマート', 'family@fam.com', 'mmm', 'ファミマ', 3, '', 2, 'on', 1, 0),
(9, 'kanda', 'kanda@adnak.com', 'kkk', '神田駅', 2, '', 1, 'on', 0, 0),
(10, 'kak', 'fahnu', 'jhj', 'jsja', 1, '', 1, 'on', 0, 0),
(11, 'aa1', 'aaaa', 'aaaaa', 'aa1', 3, '2024-05-30', 2, 'aa1', 0, 0),
(12, '会員登録', 'logo.doa@kd', 'aaa', '会員登録', 1, '2024-07-04', 1, 'on', 0, 0),
(13, '香川', 'bisrrh@ngisjr.jp', '1234', '香川', 2, '2024-05-28', 1, 'on', 0, 0),
(14, 'dadada', 'dadada@dada.da', 'fa', 'だだだ豆', 1, '2026-08-14', 2, 'on', 0, 0),
(15, '東京豆', 'dadada@dada.da', 'fa', 'だだだ豆', 1, '2026-08-14', 2, 'on', 0, 0),
(16, 'dadada', 'dadada@dada.da', 'fa', 'だだだ豆', 1, '2026-08-14', 2, 'on', 1, 0),
(17, 'dal', 'dadada@dada.da', 'fa', 'だだだ豆', 1, '2026-08-14', 2, 'on', 0, 0),
(18, '発表の時', 'dadada@dada.da', 'fa', '豆芝', 1, '2026-08-14', 2, 'on', 0, 0),
(19, '香川', 'dsf@fd', '1234', 'hrf', 2, '2024-06-13', 2, 'on', 0, 0),
(20, 'time', 'kanda@adnak.com', 'time', 'gagd', 2, '2024-06-04', 2, 'on', 0, 0);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- テーブルの AUTO_INCREMENT `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- テーブルの AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
