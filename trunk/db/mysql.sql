-- phpMyAdmin SQL Dump
-- version 2.7.0-pl2
-- http://www.phpmyadmin.net
-- 
-- Хост: localhost
-- Время создания: Фев 06 2009 г., 17:42
-- Версия сервера: 3.23.49
-- Версия PHP: 4.1.2
-- 
-- БД: `test`
-- 

-- --------------------------------------------------------

-- 
-- Структура таблицы `Authors`
-- 

DROP TABLE IF EXISTS `Authors`;
CREATE TABLE `Authors` (
  `id_author` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  PRIMARY KEY  (`id_author`)
) TYPE=MyISAM AUTO_INCREMENT=5598 ;

-- --------------------------------------------------------

-- 
-- Структура таблицы `Books`
-- 

DROP TABLE IF EXISTS `Books`;
CREATE TABLE `Books` (
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
) TYPE=MyISAM AUTO_INCREMENT=9667 ;

-- --------------------------------------------------------

-- 
-- Структура таблицы `Genres`
-- 

DROP TABLE IF EXISTS `Genres`;
CREATE TABLE `Genres` (
  `id_genre` int(18) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  PRIMARY KEY  (`id_genre`)
) TYPE=MyISAM AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

-- 
-- Структура таблицы `Orders`
-- 

DROP TABLE IF EXISTS `Orders`;
CREATE TABLE `Orders` (
  `id_order` varchar(18) NOT NULL default '',
  `isOrder` blob,
  `descripion_order` varchar(20) default NULL,
  `date_order` date default NULL,
  `id_book` int(11) NOT NULL default '0',
  `id_genre` varchar(18) NOT NULL default '',
  `id_author` int(11) NOT NULL default '0',
  `id_publisher` varchar(18) NOT NULL default '',
  PRIMARY KEY  (`id_order`,`id_book`,`id_genre`,`id_author`,`id_publisher`)
) TYPE=MyISAM;

-- --------------------------------------------------------

-- 
-- Структура таблицы `Publishers`
-- 

DROP TABLE IF EXISTS `Publishers`;
CREATE TABLE `Publishers` (
  `id_publisher` int(18) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  PRIMARY KEY  (`id_publisher`)
) TYPE=MyISAM AUTO_INCREMENT=546 ;
