-- phpMyAdmin SQL Dump
-- version 4.2.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-02-23 17:11:30
-- 服务器版本： 5.5.41-0ubuntu0.14.10.1
-- PHP Version: 5.5.12-2ubuntu4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `share`
--

-- --------------------------------------------------------

--
-- 表的结构 `think_announce`
--

CREATE TABLE IF NOT EXISTS `think_announce` (
`id` int(11) NOT NULL,
  `title` varchar(65) NOT NULL,
  `content` text NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `think_localvideo`
--

CREATE TABLE IF NOT EXISTS `think_localvideo` (
`id` int(11) NOT NULL,
  `movieid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `url` varchar(65) NOT NULL,
  `title` varchar(65) NOT NULL,
  `verify` tinyint(1) NOT NULL DEFAULT '0',
  `online` tinyint(1) NOT NULL DEFAULT '0',
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `think_notelist`
--

CREATE TABLE IF NOT EXISTS `think_notelist` (
`id` int(11) NOT NULL,
  `image` varchar(65) NOT NULL,
  `content` text NOT NULL,
  `url` varchar(65) NOT NULL,
  `userid` int(11) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `think_notice`
--

CREATE TABLE IF NOT EXISTS `think_notice` (
`id` int(11) NOT NULL,
  `title` varchar(65) NOT NULL,
  `content` text NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `think_userinfo`
--

CREATE TABLE IF NOT EXISTS `think_userinfo` (
`id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(20) NOT NULL,
  `sex` int(1) NOT NULL,
  `password` varchar(40) NOT NULL,
  `studentid` int(11) NOT NULL,
  `realname` varchar(10) NOT NULL,
  `qq` int(11) NOT NULL,
  `college` varchar(20) NOT NULL DEFAULT '保密',
  `major` varchar(20) NOT NULL DEFAULT '保密',
  `intro` text NOT NULL,
  `sharecount` int(11) NOT NULL,
  `wishcount` int(11) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `lastlogintime` datetime NOT NULL,
  `registertime` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `think_videocomment`
--

CREATE TABLE IF NOT EXISTS `think_videocomment` (
`id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `movieid` int(11) NOT NULL,
  `content` text NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `think_videocontent`
--

CREATE TABLE IF NOT EXISTS `think_videocontent` (
`id` int(11) NOT NULL,
  `movieid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `intro` text NOT NULL,
  `content` text NOT NULL,
  `verify` tinyint(1) NOT NULL DEFAULT '0',
  `time` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `think_videofavorite`
--

CREATE TABLE IF NOT EXISTS `think_videofavorite` (
`id` int(11) NOT NULL,
  `movieid` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `think_videolist`
--

CREATE TABLE IF NOT EXISTS `think_videolist` (
`id` int(11) NOT NULL,
  `name` varchar(65) NOT NULL,
  `image` varchar(65) NOT NULL,
  `type` varchar(65) NOT NULL,
  `verify` tinyint(1) NOT NULL DEFAULT '0',
  `editstatus` int(1) NOT NULL,
  `uploadstatus` int(1) NOT NULL,
  `uploadtime` datetime NOT NULL,
  `wishtime` datetime NOT NULL,
  `time` datetime NOT NULL,
  `contenttime` datetime NOT NULL,
  `downloadcount` int(11) NOT NULL,
  `playcount` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `think_videotimeline`
--

CREATE TABLE IF NOT EXISTS `think_videotimeline` (
`id` int(11) NOT NULL,
  `movieid` int(11) NOT NULL,
  `icon` varchar(40) NOT NULL,
  `title` varchar(40) NOT NULL,
  `content` varchar(65) NOT NULL,
  `footer` varchar(40) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `think_wishlist`
--

CREATE TABLE IF NOT EXISTS `think_wishlist` (
`id` int(11) NOT NULL,
  `movieid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `think_announce`
--
ALTER TABLE `think_announce`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_localvideo`
--
ALTER TABLE `think_localvideo`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_notelist`
--
ALTER TABLE `think_notelist`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_notice`
--
ALTER TABLE `think_notice`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_userinfo`
--
ALTER TABLE `think_userinfo`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_videocomment`
--
ALTER TABLE `think_videocomment`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_videocontent`
--
ALTER TABLE `think_videocontent`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_videofavorite`
--
ALTER TABLE `think_videofavorite`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_videolist`
--
ALTER TABLE `think_videolist`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_videotimeline`
--
ALTER TABLE `think_videotimeline`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_wishlist`
--
ALTER TABLE `think_wishlist`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `think_announce`
--
ALTER TABLE `think_announce`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `think_localvideo`
--
ALTER TABLE `think_localvideo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `think_notelist`
--
ALTER TABLE `think_notelist`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `think_notice`
--
ALTER TABLE `think_notice`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `think_userinfo`
--
ALTER TABLE `think_userinfo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `think_videocomment`
--
ALTER TABLE `think_videocomment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `think_videocontent`
--
ALTER TABLE `think_videocontent`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `think_videofavorite`
--
ALTER TABLE `think_videofavorite`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `think_videolist`
--
ALTER TABLE `think_videolist`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `think_videotimeline`
--
ALTER TABLE `think_videotimeline`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `think_wishlist`
--
ALTER TABLE `think_wishlist`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
