# Host: localhost  (Version 5.5.5-10.3.9-MariaDB)
# Date: 2018-12-16 21:28:04
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "tipo_usuarios"
#

CREATE TABLE `tipo_usuarios` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `stt` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

#
# Data for table "tipo_usuarios"
#

INSERT INTO `tipo_usuarios` VALUES (4,'ADMIN',1,'2018-03-16 12:56:00',NULL,NULL),(5,'GERENTE',1,'2018-03-16 12:56:00',NULL,NULL),(6,'FONO',1,'2018-03-16 12:56:00',NULL,NULL),(7,'ADMINISTRATIVO',0,'2018-03-16 12:56:00',NULL,'2018-08-11 11:16:37'),(8,'FINANCEIRO',1,'2018-03-16 12:56:00',NULL,NULL),(9,'ATENDIMENTO',1,'2018-03-16 12:56:00',NULL,NULL),(10,'TECNICO',1,'2018-03-16 12:56:00',NULL,NULL);

#
# Structure for table "usuarios"
#

CREATE TABLE `usuarios` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cor` varchar(10) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `imagem` varchar(100) DEFAULT 'default.jpg',
  `tipo` varchar(50) DEFAULT NULL,
  `stt` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

#
# Data for table "usuarios"
#

INSERT INTO `usuarios` VALUES 
(1,'#000000','JON DOE','JONDOE','2a8b3e7bbf723b52857cb9c230729ffb','jondoe@gmail.com','default.jpg','ADMIN',1,'2017-09-30 16:06:41','2018-07-20 17:22:06',NULL),
;
