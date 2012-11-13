CREATE TABLE IF NOT EXISTS `pocompiler_log` (
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `filename` varchar(50) NOT NULL,
  `compilation_time` float NOT NULL,
  `filesize` smallint(5) unsigned NOT NULL,
  `downloaded` tinyint(3) unsigned NOT NULL,
  `file_id` char(32) NOT NULL
) ENGINE=ARCHIVE DEFAULT CHARSET=utf8;
