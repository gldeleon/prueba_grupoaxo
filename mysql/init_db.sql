DROP TABLE IF EXISTS `average`;

CREATE TABLE `average` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `resultaverage` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;