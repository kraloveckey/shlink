<?php

  global $config;
  $config = [];

  // Route (path) of program installation
  $config['path'] = '/';
  // ID Length
  $config['length'] = 1;
  // Customize the prefix url (if you don't want to get it automatically）
  $config['url'] = 'https://shlink.dns.com';
  // Website title and displayed one line near the logo
  $config['title'] = 'shlink';
  // Website Description
  $config['description'] = 'Simple and fast URL shortener 🤖 This tool allows to shorten long links from any websites 🥷';
  // Information at the bottom of the website
  $config['hoster'] = 'This site is provided by <a href="https://github.com/kraloveckey">kraloveckey</a>';
  // Link expiration date in days
  $config['expiry'] = 30;

  // mysql address
  $config['mysql_host'] = "127.0.0.1";
  // mysql database
  $config['mysql_db'] = "shlink-db";
  // mysql username
  $config['mysql_user'] = "shlink-user";
  // mysql password
  $config['mysql_passwd'] = "shlink-password";

/*
CREATE TABLE `urls` (
  `uid` mediumint(8) unsigned NOT NULL auto_increment,
  `id` VARCHAR(10),
  `data` text,
  `time` datetime,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
*/
?>