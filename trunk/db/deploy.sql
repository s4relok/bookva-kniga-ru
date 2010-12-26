-- phpMyAdmin SQL Dump
-- version 3.0.0
-- http://www.phpmyadmin.net
--
-- ����: 192.168.0.29
-- ����� ��������: ��� 04 2009 �., 14:52
-- ������ �������: 5.0.67
-- ������ PHP: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- ���� ������: `b36453`
--

-- --------------------------------------------------------

--
-- ��������� ������� `Authors`
--
-- ��������: ��� 04 2009 �., 14:23
-- ��������� ����������: ��� 04 2009 �., 14:29
--

CREATE TABLE IF NOT EXISTS `Authors` (
  `id_author` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  PRIMARY KEY  (`id_author`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=5458 ;

-- --------------------------------------------------------

--
-- ��������� ������� `Books`
--
-- ��������: ��� 04 2009 �., 14:23
-- ��������� ����������: ��� 04 2009 �., 14:29
--

CREATE TABLE IF NOT EXISTS `Books` (
  `name_book` varchar(255) default NULL,
  `id_book` int(18) NOT NULL auto_increment,
  `number_book` varchar(255) default NULL,
  `year_book` varchar(255) default NULL,
  `sheets_book` varchar(255) NOT NULL default '0',
  `iscover_book` varchar(255) NOT NULL default '0',
  `isbn_book` varchar(255) default NULL,
  `wholeprice_book` varchar(255) default NULL,
  `regdate_book` varchar(255) default NULL,
  `discount_book` varchar(255) default NULL,
  `retailprice_book` varchar(255) default NULL,
  `isexist_book` varchar(255) default NULL,
  `numinstore_book` varchar(255) default NULL,
  `isnew_book` varchar(255) default NULL,
  `id_genre` int(18) NOT NULL default '0',
  `id_author` int(18) NOT NULL default '0',
  `id_publisher` int(18) NOT NULL default '0',
  PRIMARY KEY  (`id_book`,`id_genre`,`id_author`,`id_publisher`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=9021 ;

-- --------------------------------------------------------

--
-- ��������� ������� `Genres`
--
-- ��������: ��� 04 2009 �., 14:23
-- ��������� ����������: ��� 04 2009 �., 14:29
--

CREATE TABLE IF NOT EXISTS `Genres` (
  `id_genre` int(18) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  PRIMARY KEY  (`id_genre`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- ��������� ������� `Orders`
--
-- ��������: ��� 04 2009 �., 18:12
-- ��������� ����������: ��� 04 2009 �., 18:12
--

CREATE TABLE IF NOT EXISTS `Orders` (
  `id_order` varchar(18) NOT NULL default '',
  `isOrder` blob,
  `descripion_order` varchar(20) default NULL,
  `date_order` date default NULL,
  `id_book` int(11) NOT NULL default '0',
  `id_genre` varchar(18) NOT NULL default '',
  `id_author` int(11) NOT NULL default '0',
  `id_publisher` varchar(18) NOT NULL default '',
  PRIMARY KEY  (`id_order`,`id_book`,`id_genre`,`id_author`,`id_publisher`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `Publishers`
--
-- ��������: ��� 04 2009 �., 14:23
-- ��������� ����������: ��� 04 2009 �., 14:29
--

CREATE TABLE IF NOT EXISTS `Publishers` (
  `id_publisher` int(18) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  PRIMARY KEY  (`id_publisher`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=574 ;

-- --------------------------------------------------------

--
-- ��������� ������� `Users`
--
-- ��������: ��� 11 2009 �., 14:37
-- ��������� ����������: ��� 11 2009 �., 14:37
-- ��������� ��������: ��� 14 2009 �., 02:25
--

CREATE TABLE IF NOT EXISTS `Users` (
  `id_user` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `pswd` varchar(255) default NULL,
  `image_link` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=9 ;
