CREATE TABLE `customer` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `forenames` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Long enough to accomodate my christian name twice.',
  `surname` varchar(45) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Long enough to accomodate my surname.',
  `title` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Long enough to accomodate ''The Right Reverend''',
  `date_of_birth` date DEFAULT NULL,
  `mobile_number` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_address` varchar(320) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;