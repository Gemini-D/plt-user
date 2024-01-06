# ************************************************************
# Sequel Ace SQL dump
# 版本号： 20062
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# 主机: 127.0.0.1 (MySQL 8.0.32)
# 数据库: plt_user
# 生成时间: 2024-01-06 04:25:09 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# 转储表 user
# ------------------------------------------------------------

CREATE TABLE `user` (
  `id` bigint unsigned NOT NULL,
  `nickname` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '昵称',
  `created_at` datetime NOT NULL DEFAULT '2023-01-01 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '2023-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `nickname`, `created_at`, `updated_at`)
VALUES
	(186864216584192,'','2024-01-06 12:22:31','2024-01-06 12:22:31');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;


# 转储表 user_oauth
# ------------------------------------------------------------

CREATE TABLE `user_oauth` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL COMMENT '用户 ID',
  `type` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '0 微信小程序',
  `appid` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'APPID',
  `openid` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'OpenID',
  `created_at` datetime NOT NULL DEFAULT '2023-01-01 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '2023-01-01 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE_OPENID` (`openid`,`appid`,`type`),
  KEY `INDEX_USER_ID` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `user_oauth` WRITE;
/*!40000 ALTER TABLE `user_oauth` DISABLE KEYS */;

INSERT INTO `user_oauth` (`id`, `user_id`, `type`, `appid`, `openid`, `created_at`, `updated_at`)
VALUES
	(1,186864216584192,0,'wx5effdaefdbb2671f','ohjUY0TB_onjcaH2ia06HgGOC4CY','2024-01-06 12:22:31','2024-01-06 12:22:31');

/*!40000 ALTER TABLE `user_oauth` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
