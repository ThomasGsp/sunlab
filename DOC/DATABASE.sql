CREATE DATABASE sunlab;
CREATE USER 'sunlab'@'localhost' IDENTIFIED BY 'definir_ici_un_mot_de_passe';
GRANT ALL PRIVILEGES ON sunlab.* TO 'sunlab'@'localhost';
FLUSH PRIVILEGES;
use sunlab;

CREATE TABLE `members` (
  `id` char(23) NOT NULL,
  `username` varchar(65) NOT NULL DEFAULT '',
  `name` varchar(65) NOT NULL DEFAULT '',
  `firstname` varchar(65) NOT NULL DEFAULT '',
  `phone` varchar(65) NOT NULL DEFAULT '',
  `password` varchar(65) NOT NULL DEFAULT '',
  `email` varchar(65) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `accessdoor` tinyint(1) NOT NULL DEFAULT '0',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `nfccard` varchar(65) NOT NULL DEFAULT '0',
  `authtype` varchar(65) NOT NULL DEFAULT 'local',
  `mod_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `loginAttempts` (
  `IP` varchar(20) NOT NULL,
  `Attempts` int(11) NOT NULL,
  `LastLogin` datetime NOT NULL,
  `Username` varchar(65) DEFAULT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `register_guests` (
    `ID` int(11) NOT NULL AUTO_INCREMENT,
    `IP` varchar(20) NOT NULL,
    `name` varchar(65) NOT NULL DEFAULT '',
    `firstname` varchar(65) NOT NULL DEFAULT '',
    `type` varchar(65) NOT NULL DEFAULT '',
    `date` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `register_members` (
    `ID` int(11) NOT NULL AUTO_INCREMENT,
    `IP` varchar(20) NOT NULL,
    `regtype` varchar(65) NOT NULL DEFAULT 'local',
    `username` varchar(65) DEFAULT NULL,
    `date` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `door` (
  `IP` varchar(20) NOT NULL,
  `dateaccess` datetime NOT NULL,
  `username` varchar(65) DEFAULT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
