# Host: localhost:3307  (Version 5.7.23-log)
# Date: 2024-04-04 19:26:34
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "clientes"
#

CREATE TABLE `clientes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL DEFAULT '0',
  `email` varchar(100) DEFAULT NULL,
  `stt` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

#
# Data for table "clientes"
#

INSERT INTO `clientes` VALUES (1,'Pedro','pedro@gmail.com',1,'2024-03-28 21:46:01','2024-03-28 21:46:01',NULL),(2,'carlos','carlos@gmail.com',1,'2024-03-28 22:13:00','2024-03-28 22:13:00',NULL),(3,'teste2','teste2@email.com',1,'2024-04-04 19:22:59','2024-04-04 19:22:59',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

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
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

#
# Data for table "usuarios"
#

INSERT INTO `usuarios` VALUES 
(1,NULL,'JON DOE','JONDOE','e10adc3949ba59abbe56e057f20f883e','jdoe@gmail.com','default.png','ADMIN',1,'2017-09-30 16:06:41','2019-02-26 16:24:49',NULL);

# a senha é 123456 
