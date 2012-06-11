-- phpMyAdmin SQL Dump
-- version 3.4.7
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 05 月 18 日 15:54
-- 服务器版本: 5.5.17
-- PHP 版本: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `sharepic`
--

-- --------------------------------------------------------

--
-- 表的结构 `share_categories`
--

CREATE TABLE IF NOT EXISTS `share_categories` (
  `category__auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_lang` varchar(2) COLLATE utf8_unicode_ci DEFAULT 'en',
  `category_id` int(11) NOT NULL DEFAULT '0',
  `category_parent` int(11) NOT NULL DEFAULT '0',
  `category_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_safe_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rgt` int(11) NOT NULL DEFAULT '0',
  `lft` int(11) NOT NULL DEFAULT '0',
  `category_enabled` int(11) NOT NULL DEFAULT '1',
  `category_order` int(11) NOT NULL DEFAULT '0',
  `category_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_author_level` enum('normal','admin','god') CHARACTER SET utf8 NOT NULL DEFAULT 'normal',
  `category_author_group` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_votes` varchar(4) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `category_karma` varchar(4) CHARACTER SET utf8 NOT NULL DEFAULT '',
  PRIMARY KEY (`category__auto_id`),
  KEY `category_id` (`category_id`),
  KEY `category_parent` (`category_parent`),
  KEY `category_safe_name` (`category_safe_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `share_comments`
--

CREATE TABLE IF NOT EXISTS `share_comments` (
  `comment_id` int(20) NOT NULL AUTO_INCREMENT,
  `comment_randkey` int(11) NOT NULL DEFAULT '0',
  `comment_parent` int(20) DEFAULT '0',
  `comment_link_id` int(20) NOT NULL DEFAULT '0',
  `comment_user_id` int(20) NOT NULL DEFAULT '0',
  `comment_date` datetime NOT NULL,
  `comment_karma` smallint(6) NOT NULL DEFAULT '0',
  `comment_content` text COLLATE utf8_unicode_ci,
  `comment_votes` int(20) NOT NULL DEFAULT '0',
  `comment_status` enum('discard','moderated','published','spam') CHARACTER SET utf8 NOT NULL DEFAULT 'published',
  PRIMARY KEY (`comment_id`),
  UNIQUE KEY `comments_randkey` (`comment_randkey`,`comment_link_id`,`comment_user_id`,`comment_parent`),
  KEY `comment_link_id` (`comment_link_id`,`comment_parent`,`comment_date`),
  KEY `comment_link_id_2` (`comment_link_id`,`comment_date`),
  KEY `comment_date` (`comment_date`),
  KEY `comment_parent` (`comment_parent`,`comment_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `share_config`
--

CREATE TABLE IF NOT EXISTS `share_config` (
  `var_id` int(11) NOT NULL AUTO_INCREMENT,
  `var_page` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `var_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `var_value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `var_defaultvalue` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `var_optiontext` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `var_title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `var_desc` text COLLATE utf8_unicode_ci,
  `var_method` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `var_enclosein` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`var_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=106 ;

-- --------------------------------------------------------

--
-- 表的结构 `share_files`
--

CREATE TABLE IF NOT EXISTS `share_files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) DEFAULT NULL,
  `file_size` varchar(20) DEFAULT NULL,
  `file_user_id` int(11) NOT NULL,
  `file_link_id` int(11) NOT NULL,
  `file_orig_id` int(11) DEFAULT NULL,
  `file_real_size` int(11) NOT NULL,
  `file_number` tinyint(4) NOT NULL DEFAULT '1',
  `file_ispicture` tinyint(4) NOT NULL,
  `file_fields` text,
  `file_hide_thumb` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `file_hide_file` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`file_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1970 ;

-- --------------------------------------------------------

--
-- 表的结构 `share_formulas`
--

CREATE TABLE IF NOT EXISTS `share_formulas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `formula` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `share_friends`
--

CREATE TABLE IF NOT EXISTS `share_friends` (
  `friend_id` int(11) NOT NULL AUTO_INCREMENT,
  `friend_from` bigint(20) NOT NULL DEFAULT '0',
  `friend_to` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`friend_id`),
  UNIQUE KEY `friends_from_to` (`friend_from`,`friend_to`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `share_groups`
--

CREATE TABLE IF NOT EXISTS `share_groups` (
  `group_id` int(20) NOT NULL AUTO_INCREMENT,
  `group_creator` int(20) NOT NULL,
  `group_status` enum('Enable','disable') COLLATE utf8_unicode_ci NOT NULL,
  `group_members` int(20) NOT NULL,
  `group_date` datetime NOT NULL,
  `group_safename` text COLLATE utf8_unicode_ci,
  `group_name` text COLLATE utf8_unicode_ci,
  `group_description` text COLLATE utf8_unicode_ci,
  `group_privacy` enum('private','public','restricted') COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_vote_to_publish` int(20) NOT NULL,
  `group_field1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_field2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_field3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_field4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_field5` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_field6` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_notify_email` tinyint(1) NOT NULL,
  PRIMARY KEY (`group_id`),
  KEY `group_name` (`group_name`(100)),
  KEY `group_creator` (`group_creator`,`group_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `share_group_member`
--

CREATE TABLE IF NOT EXISTS `share_group_member` (
  `member_id` int(20) NOT NULL AUTO_INCREMENT,
  `member_user_id` int(20) NOT NULL,
  `member_group_id` int(20) NOT NULL,
  `member_role` enum('admin','normal','moderator','flagged','banned') CHARACTER SET utf8 NOT NULL,
  `member_status` enum('active','inactive') CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`member_id`),
  KEY `user_group` (`member_group_id`,`member_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `share_group_shared`
--

CREATE TABLE IF NOT EXISTS `share_group_shared` (
  `share_id` int(20) NOT NULL AUTO_INCREMENT,
  `share_link_id` int(20) NOT NULL,
  `share_group_id` int(20) NOT NULL,
  `share_user_id` int(20) NOT NULL,
  PRIMARY KEY (`share_id`),
  UNIQUE KEY `share_group_id` (`share_group_id`,`share_link_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `share_links`
--

CREATE TABLE IF NOT EXISTS `share_links` (
  `link_id` int(20) NOT NULL AUTO_INCREMENT,
  `link_author` int(20) NOT NULL DEFAULT '0',
  `link_status` enum('discard','queued','published','abuse','duplicated','page','spam','moderated') COLLATE utf8_unicode_ci DEFAULT 'discard',
  `link_randkey` int(20) NOT NULL DEFAULT '0',
  `link_votes` int(20) NOT NULL DEFAULT '0',
  `link_reports` int(20) NOT NULL DEFAULT '0',
  `link_comments` int(20) NOT NULL DEFAULT '0',
  `link_karma` decimal(10,2) NOT NULL DEFAULT '0.00',
  `link_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `link_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_published_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_category` int(11) NOT NULL DEFAULT '0',
  `link_lang` int(11) NOT NULL DEFAULT '1',
  `link_url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link_url_title` text COLLATE utf8_unicode_ci,
  `link_title` text COLLATE utf8_unicode_ci,
  `link_title_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link_content` mediumtext COLLATE utf8_unicode_ci,
  `link_summary` text COLLATE utf8_unicode_ci,
  `link_tags` text COLLATE utf8_unicode_ci,
  `link_field1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link_field2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link_field3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link_field4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link_field5` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link_field6` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link_field7` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link_field8` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link_field9` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link_field10` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link_field11` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link_field12` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link_field13` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link_field14` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link_field15` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link_group_id` int(20) NOT NULL DEFAULT '0',
  `link_group_status` enum('queued','published','discard') CHARACTER SET utf8 NOT NULL DEFAULT 'queued',
  `link_out` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`link_id`),
  KEY `link_author` (`link_author`),
  KEY `link_url` (`link_url`),
  KEY `link_status` (`link_status`),
  KEY `link_title_url` (`link_title_url`),
  KEY `link_date` (`link_date`),
  KEY `link_published_date` (`link_published_date`),
  FULLTEXT KEY `link_url_2` (`link_url`,`link_url_title`,`link_title`,`link_content`,`link_tags`),
  FULLTEXT KEY `link_tags` (`link_tags`),
  FULLTEXT KEY `link_search` (`link_title`,`link_content`,`link_tags`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1260 ;

-- --------------------------------------------------------

--
-- 表的结构 `share_login_attempts`
--

CREATE TABLE IF NOT EXISTS `share_login_attempts` (
  `login_id` int(11) NOT NULL AUTO_INCREMENT,
  `login_username` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_time` datetime NOT NULL,
  `login_ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`login_id`),
  UNIQUE KEY `login_username` (`login_ip`,`login_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `share_messages`
--

CREATE TABLE IF NOT EXISTS `share_messages` (
  `idMsg` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `sender` int(11) NOT NULL DEFAULT '0',
  `receiver` int(11) NOT NULL DEFAULT '0',
  `senderLevel` int(11) NOT NULL DEFAULT '0',
  `readed` int(11) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idMsg`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `share_misc_data`
--

CREATE TABLE IF NOT EXISTS `share_misc_data` (
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `data` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `share_modules`
--

CREATE TABLE IF NOT EXISTS `share_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `version` float NOT NULL,
  `latest_version` float NOT NULL,
  `folder` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- 表的结构 `share_redirects`
--

CREATE TABLE IF NOT EXISTS `share_redirects` (
  `redirect_id` int(11) NOT NULL AUTO_INCREMENT,
  `redirect_old` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `redirect_new` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`redirect_id`),
  KEY `redirect_old` (`redirect_old`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `share_saved_links`
--

CREATE TABLE IF NOT EXISTS `share_saved_links` (
  `saved_id` int(11) NOT NULL AUTO_INCREMENT,
  `saved_user_id` int(11) NOT NULL,
  `saved_link_id` int(11) NOT NULL,
  `saved_privacy` enum('private','public') CHARACTER SET utf8 NOT NULL DEFAULT 'public',
  PRIMARY KEY (`saved_id`),
  KEY `saved_user_id` (`saved_user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `share_tags`
--

CREATE TABLE IF NOT EXISTS `share_tags` (
  `tag_link_id` int(11) NOT NULL DEFAULT '0',
  `tag_lang` varchar(4) COLLATE utf8_unicode_ci DEFAULT 'en',
  `tag_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tag_words` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  UNIQUE KEY `tag_link_id` (`tag_link_id`,`tag_lang`,`tag_words`),
  KEY `tag_lang` (`tag_lang`,`tag_date`),
  KEY `tag_words` (`tag_words`,`tag_link_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `share_tag_cache`
--

CREATE TABLE IF NOT EXISTS `share_tag_cache` (
  `tag_words` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `count` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `share_totals`
--

CREATE TABLE IF NOT EXISTS `share_totals` (
  `name` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `total` int(11) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `share_trackbacks`
--

CREATE TABLE IF NOT EXISTS `share_trackbacks` (
  `trackback_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trackback_link_id` int(11) NOT NULL DEFAULT '0',
  `trackback_user_id` int(11) NOT NULL DEFAULT '0',
  `trackback_type` enum('in','out') COLLATE utf8_unicode_ci DEFAULT 'in',
  `trackback_status` enum('ok','pendent','error') COLLATE utf8_unicode_ci DEFAULT 'pendent',
  `trackback_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `trackback_date` timestamp NULL DEFAULT NULL,
  `trackback_url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trackback_title` text COLLATE utf8_unicode_ci,
  `trackback_content` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`trackback_id`),
  UNIQUE KEY `trackback_link_id_2` (`trackback_link_id`,`trackback_type`,`trackback_url`),
  KEY `trackback_link_id` (`trackback_link_id`),
  KEY `trackback_url` (`trackback_url`),
  KEY `trackback_date` (`trackback_date`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- 表的结构 `share_users`
--

CREATE TABLE IF NOT EXISTS `share_users` (
  `user_id` int(20) NOT NULL AUTO_INCREMENT,
  `user_login` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_level` enum('normal','admin','god','Spammer') COLLATE utf8_unicode_ci DEFAULT 'normal',
  `user_modification` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_pass` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_email` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_names` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_karma` decimal(10,2) DEFAULT '0.00',
  `user_url` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_lastlogin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_aim` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_msn` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_yahoo` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_gtalk` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_skype` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_irc` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_avatar_source` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_ip` varchar(20) COLLATE utf8_unicode_ci DEFAULT '0',
  `user_lastip` varchar(20) COLLATE utf8_unicode_ci DEFAULT '0',
  `last_reset_request` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_email_friend` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_reset_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_occupation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_categories` varchar(1024) COLLATE utf8_unicode_ci DEFAULT '',
  `user_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `user_language` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_login` (`user_login`),
  KEY `user_email` (`user_email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `share_votes`
--

CREATE TABLE IF NOT EXISTS `share_votes` (
  `vote_id` int(20) NOT NULL AUTO_INCREMENT,
  `vote_type` enum('links','comments') CHARACTER SET utf8 NOT NULL DEFAULT 'links',
  `vote_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `vote_link_id` int(20) NOT NULL DEFAULT '0',
  `vote_user_id` int(20) NOT NULL DEFAULT '0',
  `vote_value` smallint(11) NOT NULL DEFAULT '1',
  `vote_karma` int(11) DEFAULT '0',
  `vote_ip` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`vote_id`),
  KEY `user_id` (`vote_user_id`),
  KEY `link_id` (`vote_link_id`),
  KEY `vote_type` (`vote_type`,`vote_link_id`,`vote_user_id`,`vote_ip`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- 表的结构 `share_widgets`
--

CREATE TABLE IF NOT EXISTS `share_widgets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `version` float NOT NULL,
  `latest_version` float NOT NULL,
  `folder` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL,
  `column` enum('left','right') COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `display` char(5) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `folder` (`folder`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
