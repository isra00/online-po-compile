CREATE TABLE `pocompiler_log` (
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `filename` varchar(50) NOT NULL,
  `compilation_time` float NOT NULL,
  `filesize_po` smallint(5) unsigned NOT NULL,
  `filesize_mo` smallint(5) unsigned NOT NULL,
  `file_id` char(32) NOT NULL
) ENGINE=ARCHIVE DEFAULT CHARSET=utf8;