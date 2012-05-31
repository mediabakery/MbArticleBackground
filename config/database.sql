-- ********************************************************
-- *                                                      *
-- * IMPORTANT NOTE                                       *
-- *                                                      *
-- * Do not import this file manually but use the Contao  *
-- * install tool to create and maintain database tables! *
-- *                                                      *
-- ********************************************************

-- 
-- Table `tl_article`
-- 

CREATE TABLE `tl_article` (
  `mb_articlebackground` char(1) NOT NULL default '',
  `mb_articlebackground_src` varchar(255) NOT NULL default '',
  `mb_articlebackground_position` varchar(60) NOT NULL default '',
  `mb_articlebackground_repeat` varchar(10) NOT NULL default '',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

