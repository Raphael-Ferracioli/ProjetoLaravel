-- 
-- Estrutura da tabela `contact_requests`
-- 

DROP TABLE IF EXISTS `contact_requests`;
CREATE TABLE `contact_requests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `from_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `via` enum('email','whatsapp','phone','website') COLLATE utf8mb4_unicode_ci DEFAULT 'email',
  `status` enum('new','read','responded') COLLATE utf8mb4_unicode_ci DEFAULT 'new',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `contact_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 
-- Estrutura da tabela `migrations`
-- 

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 
-- Estrutura da tabela `password_resets`
-- 

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_email` (`email`),
  KEY `idx_token` (`token`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 
-- Dados da tabela `password_resets`
-- 

INSERT INTO `password_resets` VALUES ('18', 'gabiel4k12@gmail.com', '98a2bf2927e79b40e5022514c8cf92bbe357c0aee368c1ca196f8fe688c01231', '2025-11-25 12:57:12', '2025-11-25 08:57:16');

-- 
-- Estrutura da tabela `site_settings`
-- 

DROP TABLE IF EXISTS `site_settings`;
CREATE TABLE `site_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `setting_value` text COLLATE utf8mb4_unicode_ci,
  `setting_type` enum('string','integer','boolean','json') COLLATE utf8mb4_unicode_ci DEFAULT 'string',
  `description` text COLLATE utf8mb4_unicode_ci,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_key` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 
-- Estrutura da tabela `specialties`
-- 

DROP TABLE IF EXISTS `specialties`;
CREATE TABLE `specialties` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `slug` (`slug`),
  KEY `idx_name` (`name`),
  KEY `idx_specialties_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 
-- Dados da tabela `specialties`
-- 

INSERT INTO `specialties` VALUES ('1', 'Contabilidade Geral', 'contabilidade-geral', 'Serviços gerais de contabilidade empresarial', '1', '2025-09-18 00:21:01');
INSERT INTO `specialties` VALUES ('2', 'Contabilidade Tributária', 'contabilidade-tributaria', 'Especialização em impostos e tributos', '1', '2025-09-18 00:21:01');
INSERT INTO `specialties` VALUES ('3', 'Auditoria', 'auditoria', 'Auditoria interna e externa', '1', '2025-09-18 00:21:01');
INSERT INTO `specialties` VALUES ('4', 'Perícia Contábil', 'pericia-contabil', 'Perícias judiciais e extrajudiciais', '1', '2025-09-18 00:21:01');
INSERT INTO `specialties` VALUES ('5', 'Consultoria Empresarial', 'consultoria-empresarial', 'Consultoria em gestão e negócios', '1', '2025-09-18 00:21:01');

-- 
-- Estrutura da tabela `user_specialties`
-- 

DROP TABLE IF EXISTS `user_specialties`;
CREATE TABLE `user_specialties` (
  `user_id` int(10) unsigned NOT NULL,
  `specialty_id` int(10) unsigned NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`,`specialty_id`),
  KEY `idx_specialty` (`specialty_id`),
  KEY `idx_user` (`user_id`),
  KEY `idx_user_specialties_specialty` (`specialty_id`),
  CONSTRAINT `user_specialties_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_specialties_ibfk_2` FOREIGN KEY (`specialty_id`) REFERENCES `specialties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 
-- Dados da tabela `user_specialties`
-- 

INSERT INTO `user_specialties` VALUES ('3', '1', '2025-09-18 02:22:44');
INSERT INTO `user_specialties` VALUES ('3', '3', '2025-09-18 02:22:44');
INSERT INTO `user_specialties` VALUES ('3', '4', '2025-09-18 02:22:47');
INSERT INTO `user_specialties` VALUES ('3', '5', '2025-09-20 20:51:54');
INSERT INTO `user_specialties` VALUES ('4', '1', '2025-09-20 12:46:33');
INSERT INTO `user_specialties` VALUES ('4', '4', '2025-09-20 12:46:33');
INSERT INTO `user_specialties` VALUES ('5', '1', '2025-09-22 13:24:44');
INSERT INTO `user_specialties` VALUES ('5', '5', '2025-09-22 13:24:44');
INSERT INTO `user_specialties` VALUES ('7', '2', '2025-09-22 17:45:07');
INSERT INTO `user_specialties` VALUES ('7', '5', '2025-09-22 17:45:07');
INSERT INTO `user_specialties` VALUES ('11', '1', '2025-10-13 21:17:28');
INSERT INTO `user_specialties` VALUES ('11', '2', '2025-10-13 21:17:28');
INSERT INTO `user_specialties` VALUES ('11', '3', '2025-10-13 21:17:28');
INSERT INTO `user_specialties` VALUES ('11', '5', '2025-10-13 21:17:28');
INSERT INTO `user_specialties` VALUES ('29', '1', '2025-10-09 09:48:40');
INSERT INTO `user_specialties` VALUES ('29', '5', '2025-10-09 09:48:40');
INSERT INTO `user_specialties` VALUES ('33', '1', '2025-10-23 13:42:54');
INSERT INTO `user_specialties` VALUES ('33', '2', '2025-10-23 13:42:54');
INSERT INTO `user_specialties` VALUES ('33', '5', '2025-10-23 13:42:54');
INSERT INTO `user_specialties` VALUES ('34', '1', '2025-10-23 14:00:11');
INSERT INTO `user_specialties` VALUES ('34', '2', '2025-10-23 14:00:11');
INSERT INTO `user_specialties` VALUES ('34', '5', '2025-10-23 14:00:11');
INSERT INTO `user_specialties` VALUES ('35', '1', '2025-10-23 14:21:24');
INSERT INTO `user_specialties` VALUES ('36', '1', '2025-10-23 14:25:36');
INSERT INTO `user_specialties` VALUES ('36', '2', '2025-10-23 14:25:36');
INSERT INTO `user_specialties` VALUES ('36', '5', '2025-10-23 14:25:36');
INSERT INTO `user_specialties` VALUES ('37', '1', '2025-10-23 15:07:40');
INSERT INTO `user_specialties` VALUES ('38', '1', '2025-10-23 16:46:53');
INSERT INTO `user_specialties` VALUES ('38', '2', '2025-10-23 16:46:53');
INSERT INTO `user_specialties` VALUES ('39', '1', '2025-10-23 16:52:23');
INSERT INTO `user_specialties` VALUES ('39', '2', '2025-10-23 16:52:23');
INSERT INTO `user_specialties` VALUES ('41', '1', '2025-10-23 18:03:42');
INSERT INTO `user_specialties` VALUES ('42', '1', '2025-10-23 17:25:30');
INSERT INTO `user_specialties` VALUES ('42', '2', '2025-10-23 17:25:30');
INSERT INTO `user_specialties` VALUES ('42', '5', '2025-10-23 17:25:30');
INSERT INTO `user_specialties` VALUES ('43', '1', '2025-10-23 17:53:39');
INSERT INTO `user_specialties` VALUES ('43', '2', '2025-10-23 17:53:39');
INSERT INTO `user_specialties` VALUES ('43', '5', '2025-10-23 17:53:39');
INSERT INTO `user_specialties` VALUES ('45', '1', '2025-10-24 09:44:02');
INSERT INTO `user_specialties` VALUES ('45', '2', '2025-10-24 09:44:02');
INSERT INTO `user_specialties` VALUES ('45', '5', '2025-10-24 09:44:02');
INSERT INTO `user_specialties` VALUES ('46', '1', '2025-10-24 11:05:32');
INSERT INTO `user_specialties` VALUES ('46', '2', '2025-10-24 11:05:32');
INSERT INTO `user_specialties` VALUES ('46', '5', '2025-10-24 11:05:32');
INSERT INTO `user_specialties` VALUES ('47', '1', '2025-10-24 11:23:57');
INSERT INTO `user_specialties` VALUES ('47', '2', '2025-10-24 11:23:57');
INSERT INTO `user_specialties` VALUES ('47', '5', '2025-10-24 11:23:57');
INSERT INTO `user_specialties` VALUES ('48', '1', '2025-10-24 13:32:54');
INSERT INTO `user_specialties` VALUES ('48', '2', '2025-10-24 13:32:54');
INSERT INTO `user_specialties` VALUES ('48', '5', '2025-10-24 13:32:54');
INSERT INTO `user_specialties` VALUES ('49', '1', '2025-10-24 13:44:14');
INSERT INTO `user_specialties` VALUES ('49', '2', '2025-10-24 13:44:14');
INSERT INTO `user_specialties` VALUES ('49', '3', '2025-10-24 13:44:14');
INSERT INTO `user_specialties` VALUES ('49', '4', '2025-10-24 13:44:14');
INSERT INTO `user_specialties` VALUES ('49', '5', '2025-10-24 13:44:14');
INSERT INTO `user_specialties` VALUES ('50', '1', '2025-10-24 14:06:03');
INSERT INTO `user_specialties` VALUES ('50', '2', '2025-10-24 14:06:03');
INSERT INTO `user_specialties` VALUES ('50', '4', '2025-10-24 14:06:03');
INSERT INTO `user_specialties` VALUES ('50', '5', '2025-10-24 14:06:03');
INSERT INTO `user_specialties` VALUES ('52', '1', '2025-11-04 16:27:39');
INSERT INTO `user_specialties` VALUES ('53', '1', '2025-11-20 21:27:21');
INSERT INTO `user_specialties` VALUES ('53', '2', '2025-11-20 21:27:21');
INSERT INTO `user_specialties` VALUES ('53', '3', '2025-11-24 13:37:05');
INSERT INTO `user_specialties` VALUES ('53', '5', '2025-11-17 12:24:43');
INSERT INTO `user_specialties` VALUES ('57', '5', '2025-11-18 12:34:57');
INSERT INTO `user_specialties` VALUES ('58', '1', '2025-11-18 12:37:27');
INSERT INTO `user_specialties` VALUES ('59', '1', '2025-11-19 09:54:42');
INSERT INTO `user_specialties` VALUES ('62', '2', '2025-11-19 10:05:25');
INSERT INTO `user_specialties` VALUES ('63', '1', '2025-11-19 18:03:57');
INSERT INTO `user_specialties` VALUES ('63', '2', '2025-11-19 18:03:57');
INSERT INTO `user_specialties` VALUES ('63', '5', '2025-11-19 18:03:57');
INSERT INTO `user_specialties` VALUES ('65', '3', '2025-11-19 23:54:41');
INSERT INTO `user_specialties` VALUES ('66', '1', '2025-11-20 21:28:18');
INSERT INTO `user_specialties` VALUES ('67', '1', '2025-11-24 11:25:42');
INSERT INTO `user_specialties` VALUES ('69', '5', '2025-11-24 11:38:36');
INSERT INTO `user_specialties` VALUES ('71', '2', '2025-11-24 14:13:26');
INSERT INTO `user_specialties` VALUES ('72', '1', '2025-11-24 14:16:00');

-- 
-- Estrutura da tabela `users`
-- 

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cep` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `email_verified` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `photo_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `idx_city` (`city`),
  KEY `idx_state` (`state`),
  KEY `idx_name` (`name`),
  KEY `idx_email` (`email`),
  KEY `idx_users_city_state` (`city`,`state`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 
-- Dados da tabela `users`
-- 

INSERT INTO `users` VALUES ('3', 'andreialvesrealdev@gmail.com', '$2y$10$VUjTRD8chZDNsAvNOmgFCu10IPdZ.w1W3SYSeQoZDPmlvfsC54BFi', 'Andrei Alves Santos', '22790-704', 'RJ', 'Rio de Janeiro', 'Avenida das Américas', '32998181743', '32123456789123', 'https://facebook.com/andreialvesreal', NULL, 'https://linkedin.com/in/andreialvesreal/', 'KANSIASNFIANSFNA', '1', '0', '2025-09-18 00:53:03', '2025-09-20 20:52:01', 'uploads/avatars/avatar_u3_ffbdea8d34665768.jpg');
INSERT INTO `users` VALUES ('4', 'mail@mail.com', '$2y$10$x6tZB7u0MP0Wd4G0bAbObeCDe8nHJfxiOzT9wLrjoOrZ9FspHyEfa', 'Teste Usuário', '36088485', 'MG', 'Juiz de Fora', 'Avenida Luiza Vitória Fernandes', NULL, NULL, NULL, NULL, NULL, 'Lorem Ipsum Dolor Sit Amet', '0', '0', '2025-09-19 03:35:20', '2025-10-24 14:09:53', NULL);
INSERT INTO `users` VALUES ('5', 'paulovilalta@gmail.com', '$2y$10$zpXKxNW4RlsCSy9kbeQS7e8Ls7nhNXPqrost2WjdOhjjPhA739cEq', 'Paulo Vilalta', '22790704', 'RJ', 'Rio de Janeiro', 'Avenida das Américas', '(51) 912345-6789', '(12) 12345578963', NULL, NULL, NULL, 'Aliquam non tempus nulla, a feugiat urna. Maecenas rutrum pretium ex, sed pulvinar orci dictum id. Curabitur mollis placerat nulla, nec lacinia erat pulvinar nec. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Phasellus ac fermentum nibh, vitae pretium nisl.', '1', '0', '2025-09-22 13:23:00', '2025-09-22 13:27:11', 'uploads/avatars/avatar_u5_10a7f7430bf1973b.png');
INSERT INTO `users` VALUES ('6', 'mail@gmail.com', '$2y$10$3QlHWcPdHB.m4L8ehU68jO6BEb0QDfa/WL8Pn/PPMMPsB1jU35.j2', 'Testee', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-09-22 17:29:02', '2025-09-22 17:29:02', NULL);
INSERT INTO `users` VALUES ('7', 'atami@atamiempresarial.com.br', '$2y$10$NQ8dMtJ5pGokZ5WHbDvzu.EiKIfAeZjIi3tr72LF2vOHUchrfyO.e', 'Atami Assessoria Contábil', '36088485', 'MG', 'Juiz de Fora', 'Avenida Luiza Vitória Fernandes, 200', '(12) 12345578963', '(51) 912345-6789', NULL, NULL, NULL, 'Etiam vitae ex vitae lorem pharetra tempor. Curabitur rutrum dolor non est tincidunt hendrerit. Nam magna massa, pharetra et nisl nec, blandit vulputate purus. Vestibulum feugiat, augue in iaculis semper, ligula orci efficitur quam, a luctus mi risus id sapien. Integer fringilla odio et luctus dignissim. Phasellus lacinia porttitor justo,', '1', '0', '2025-09-22 17:44:25', '2025-09-22 17:46:58', 'uploads/avatars/avatar_u7_b04262d1e22688ba.png');
INSERT INTO `users` VALUES ('8', 'teste@teste.com', '$2y$10$eKoV9LTth8h5GTH5n8TNDuZU.ZaFNMavikf4QGQ9x4uLNIKezRhSa', 'Teste novo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-09-26 20:34:33', '2025-09-26 20:34:33', NULL);
INSERT INTO `users` VALUES ('9', 'emailnovo123@gmail.com', '$2y$10$0ftmJ9.KvzDBCCQZ2iGcKeJ5.67lbK/aIbLs.3s/bb8GwJNoZeZti', 'Apenas um teste', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-09-29 12:45:58', '2025-09-29 12:45:58', NULL);
INSERT INTO `users` VALUES ('10', 'edmarco@escritoriolimeira.com.br', '$2y$10$aHGLmyRMX5jC19vvcwmSF.aGtYDnJT5jX9RKNZNZTPO4tDp1gr486', 'EDMARCO ANTONIO SALMAZZO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-09-30 13:36:43', '2025-09-30 13:36:43', NULL);
INSERT INTO `users` VALUES ('11', 'paulo@atamiempresarial.com.br', '$2y$10$sWer/NCQhPg7TG8puZBBAepKVHGA8T6pHys9XeyM5sLpPbSuMALqC', 'Atami Assessoria Contabil', '13484050', 'SP', 'Limeira', 'Rua Tatuibi 507', '19 98220-0364', '19 98220-0364', NULL, NULL, NULL, 'Servicos nas áreas Tributárias, Fiscal, Pessoal, Contábil e Societário. Fundada em 01.03.1989', '1', '0', '2025-09-30 22:23:40', '2025-10-14 16:44:42', NULL);
INSERT INTO `users` VALUES ('12', 'vilaltasoftware@gmail.com', '$2y$10$MYbTZdUBrZm4.RswlD6L5.OoR.x55zaWIYGuh/3Msog8O9e5R.vcu', 'Atami Assessoria Contabil', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-09-30 22:24:30', '2025-09-30 22:24:30', NULL);
INSERT INTO `users` VALUES ('13', 'contabilean@gmail.com', '$2y$10$bEbvfy4VttKTSmnr1/kRvOMnTzwNoOO67MY12/Nxw2BrDsAAEL4MO', 'Edilene Silva Casagrande', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-10-01 12:11:52', '2025-10-01 12:11:52', NULL);
INSERT INTO `users` VALUES ('14', 'pamela.lagazzi@uol.com.br', '$2y$10$ti1ke5rXDWclS2o2bsZVrOx.TJbUWJhPiLbZ9755lfGzby9Tg4jBK', 'Pamela Lagazzi Alonso', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-10-01 12:16:44', '2025-10-01 12:16:44', NULL);
INSERT INTO `users` VALUES ('15', 'katia@conkagi.com.br', '$2y$10$50T9B/q5OUycKiBv9/vDnOK..XTAO2nl8SIFbvlYdb8m8bLDqU7XK', 'KÁTIA Fonseca Calegarini', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-10-01 14:19:33', '2025-10-01 14:19:33', NULL);
INSERT INTO `users` VALUES ('16', 'diretoria@anicetoeassociados.com.br', '$2y$10$Ozdxwf00MvmuvSaNh.JP1eGsMYWGiJ2dElKaDoIn5Kxrqk4FvPuq6', 'ADALBERTO ANICETO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-10-01 17:38:58', '2025-10-01 17:38:58', NULL);
INSERT INTO `users` VALUES ('17', 'macini@macinicontabilidade.com.br', '$2y$10$VujAdohgXfvc6SsPbreE9.Yt7nsu7xK01CVSdp1DYK8JgxSQTu1au', 'Emerson Carlos Macini', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-10-02 12:28:40', '2025-10-02 12:28:40', NULL);
INSERT INTO `users` VALUES ('18', 'ddperao@hitmail.com', '$2y$10$Vpx5uaSJXEEWYvLRsLTLjOZTfCdi5.vxN7GjPW8Uorov2d6aI1A/.', 'Danilson Donizetti Perão', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-10-02 12:28:54', '2025-10-02 12:28:54', NULL);
INSERT INTO `users` VALUES ('19', 'andrealtoe@gmail.com', '$2y$10$9hQocP2BGUaQ3Zrjf3GZWuxlkk74uXQ1xlFTfEuabg.uDS27PD0Dq', 'André Altoé', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-10-02 12:28:59', '2025-10-02 12:28:59', NULL);
INSERT INTO `users` VALUES ('20', 'victor.antonele@tax5.com.br', '$2y$10$pXc1Mo4GyEvhUxA0pXlNV.KDyTtvnpBgV8oPGJOyMTivjNQdiKZF.', 'VICTOR AUGUSTO ANTONELE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-10-02 13:37:16', '2025-10-02 13:37:16', NULL);
INSERT INTO `users` VALUES ('21', 'neusa@contabilbarueri.com.br', '$2y$10$n0xDPakXK7vSSoQ8P4W1tekuOk3141oTvAsn.Jd2jQMF1LVeshYU.', 'Escritório Contábil Barueri', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-10-02 15:30:00', '2025-10-02 15:30:00', NULL);
INSERT INTO `users` VALUES ('22', 'milene@paraisodoverde.com.br', '$2y$10$dbGrT/e0ld9AIZ6bS2RzZ.ryApRhRBp9Y1l61SVzvboYuoOUNOyti', 'Escritório Paraíso do Verde', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-10-02 17:10:29', '2025-10-02 17:10:29', NULL);
INSERT INTO `users` VALUES ('23', 'contatovilasoftware@gmail.com', '$2y$10$FoQ/ahnHkSWsh.0mUG.yTOFId2fOYc0/xuAny0EjuowO2I3H8foSa', 'Vilasoftware', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-10-02 22:31:10', '2025-10-02 22:31:10', NULL);
INSERT INTO `users` VALUES ('24', 'contato@vilasoftware.com.br', '$2y$10$elpoZM6zoi1A9g4hTeqOqeDG78FEPz2GFwmIpoTGJQQkcDxESLMs.', 'Teste Novo VilaSoftware', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-10-02 22:41:08', '2025-10-02 22:41:08', NULL);
INSERT INTO `users` VALUES ('25', 'contadorcompositor@gmail.com', '$2y$10$b1S1V19kyO1BRSBjNFpsMO2E3khrarslticHurvy8TwmCiDraSfS.', 'Vilasoftware Desenvolvimento de Software', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-10-06 18:49:24', '2025-10-06 18:49:24', NULL);
INSERT INTO `users` VALUES ('26', '000@mail.com', '$2y$10$LrhGsbp4JN.WBKg2tpUO7.2eR2sRAzKT2Oq5p4HT9xyc.N3oBs9na', 'Teste Vila 000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-10-09 09:17:57', '2025-10-09 09:17:57', NULL);
INSERT INTO `users` VALUES ('27', '001@mail.com', '$2y$10$zvgop.qwF3iHaWYzY9qYiuwkujZihsX8gc6N5oBbKjvLVPVAj.1YC', 'Teste Vila 001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-10-09 09:22:58', '2025-10-09 09:22:58', NULL);
INSERT INTO `users` VALUES ('28', '002@mail.com', '$2y$10$9lql2y8hBaisOcPLSlz8YeOAYE1HEnPRGnzBxhiOc6rtMLmEQt8gK', 'Teste Vila 002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-10-09 09:26:03', '2025-10-09 09:26:03', NULL);
INSERT INTO `users` VALUES ('29', '003@mail.com', '$2y$10$1ZEEoM3lSQ4/YmMc3j4DpuRfGbwjN283q991NsZuhDL4soojem22y', 'Teste Vila 003', '36088485', 'MG', 'Juiz de Fora', 'Avenida Luiza Vitória Fernandes', '(12) 12345578963', '(12) 123455789631', NULL, NULL, NULL, 'Teste Teste Teste Teste Teste Teste Teste', '0', '0', '2025-10-09 09:31:20', '2025-10-09 09:51:52', NULL);
INSERT INTO `users` VALUES ('30', 'renildomg@gmail.com', '$2y$10$WGVMUjmvTS0BbhuZq5/gJuwFED88S6aPusK5t7Nd/ag1nhogKCwta', 'Renildo Dias de Oliveira', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-10-22 20:07:03', '2025-10-22 20:07:03', NULL);
INSERT INTO `users` VALUES ('31', 'jadson@ricarte.com.br', '$2y$10$HeDmo0DTkprQ.z6LKmTTZORqiEIHDSG7WpxSkict/HnF9MRulqfuS', 'Jádson Ricarte', '49020030', 'SE', 'Aracaju', 'Rua Vereador João CalazanS, 98', '7921063800', '79999722568', NULL, NULL, NULL, 'Ricarte Contabilidade', '0', '0', '2025-10-23 10:50:22', '2025-10-23 10:55:47', NULL);
INSERT INTO `users` VALUES ('32', 'joaoizaias@jicontabilidade.com.br', '$2y$10$HEDWvZ48WpROeCDw8WW0TeWYZPe3y0ShHzXabqaryYyUx3CZ7.9eC', 'João Izaias Andrade Oliveira', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Escritório contábil especializado em\r\nConstrução civil', '0', '0', '2025-10-23 10:52:43', '2025-10-23 10:55:13', NULL);
INSERT INTO `users` VALUES ('33', 'dorotea@epoca-cont.com.br', '$2y$10$PhOb93RsTyVzQOlIABPDMOE4AgMTMh1RFPP4COBQX6XLjqIJBEl2u', 'Dorotéa Hackbarth', '89204170', 'SC', 'Joinville', 'Rua Dom Pedro I 52', '047996818084', '047996818084', NULL, NULL, NULL, 'Contabilidade assessoria tributária pessoal e fiscal', '1', '0', '2025-10-23 13:41:48', '2025-10-23 13:45:00', NULL);
INSERT INTO `users` VALUES ('34', 'ricardo@deltabrasil.com.br', '$2y$10$nbVZG9wMsqDNvMP9nbVa4OrAdcd1oMNwaF.hcjmLekiyuhu/8me6y', 'Ricardo Coelho de Oliveira Costa', '02125-030', 'SP', 'São Paulo', 'Rua Horácio de Castilho', '1134735750', '1134735750', NULL, NULL, NULL, 'Empresa especializada em contabilidade geral, para empresas de todos os seguimentos.', '1', '0', '2025-10-23 13:59:00', '2025-10-23 14:03:32', NULL);
INSERT INTO `users` VALUES ('35', 'elistefani1975@gmail.com', '$2y$10$Wb.OjvOO/OEBTPg5JHdpFucJf6aaJFFD0LBc.M2JjWBG3LQfvErfy', 'Elisângela Stefani', '18133040', 'SP', 'São Roque', 'Rua Francisco da Silva Pontes, 24', '11999444262', '11999444262', NULL, NULL, NULL, NULL, '0', '0', '2025-10-23 14:20:01', '2025-10-23 14:22:14', NULL);
INSERT INTO `users` VALUES ('36', 'aldines.2@hotmail.com', '$2y$10$2norT0m96zP4MvlY5to/MuBjT0L.H/QlJqs7szWFo2ERDrps9ukl6', 'Aldines Aparecida Silva Gon', '16015495', 'SP', 'Araçatuba', 'Rua Euclides da Cunha  610', '18981356592', 'aldinesgon', NULL, 'https://aldinesgon', 'https://aldines.2@hotmail.com', NULL, '0', '0', '2025-10-23 14:25:00', '2025-10-23 14:28:47', NULL);
INSERT INTO `users` VALUES ('37', 'elisangelaveneranda@gmail.com', '$2y$10$lJRK3d8lwLaFANhrrKCor.WKAFUlyEvVKYPGtGCwINiNeByL1t64K', 'Elisangela Veneranda', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-10-23 15:07:07', '2025-10-23 15:07:07', NULL);
INSERT INTO `users` VALUES ('38', 'elaine@luxcontabilidade.com', '$2y$10$T9csEDTkf4Xl67OInSARKu45NqsJslaD0DIB5a1/Gm3JH6WN79Sde', 'Elaine da Silva Ramos', '87701010', 'PR', 'Paranavaí', 'Rua Pernambuco, 707', '4430453700', '44997012574', NULL, NULL, NULL, 'Contabilidade em geral', '1', '0', '2025-10-23 16:46:37', '2025-10-23 16:48:37', NULL);
INSERT INTO `users` VALUES ('39', 'gisleihemsing@gmail.com', '$2y$10$w9gIYzYz5n0EVSp6SmaiJ.A2XRCTU94i67Gz3m5dScksw7RJjCma2', 'Gislei Hemsing', '88010020', 'SC', 'Florianópolis', 'Rua Deodoro 200 sl 25', NULL, '048998156158', NULL, NULL, NULL, 'Serviços contábeis assessoria tributária contabilidade condaminial', '1', '0', '2025-10-23 16:51:52', '2025-10-23 16:54:04', NULL);
INSERT INTO `users` VALUES ('40', 'juliana@3ginovacao.com.br', '$2y$10$400cHydz3ZnI2iW2ChUU5.baiIq3qqbv2JjZTnuiAhP7oQGgQf6IO', 'Juliana Favero Brandão', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-10-23 16:52:24', '2025-10-23 16:52:24', NULL);
INSERT INTO `users` VALUES ('41', 'topcontabeis2@gmail.com', '$2y$10$tfkdagf3mF3U0AdHfiigNuDyZ637VOAIMr7JwKdLVeqVl1UccIg1y', 'Sérgio Cristian Emydio dos Santos', '13490019', 'SP', 'Cordeirópolis', 'Rua 13 de Maio', NULL, '19982105765', NULL, NULL, NULL, 'Certificados Digitais para todo o Brasil', '1', '0', '2025-10-23 17:20:26', '2025-10-23 18:04:08', NULL);
INSERT INTO `users` VALUES ('42', 'diretoria@anjosfeller.com.br', '$2y$10$umzCydf/KQ0pD4eEqnd7h.0Uee42K.Nmjf7mTNPpDDWV48nIXrkv2', 'Claudiane Feller dos Anjos', '88200070', 'SC', 'Tijucas', 'Avenida Bayer Filho, 1625 sala 101', '48996098073', '48996098073', NULL, NULL, NULL, 'Escrito de Contabilidade Consultivo', '1', '0', '2025-10-23 17:25:11', '2025-10-23 17:27:24', NULL);
INSERT INTO `users` VALUES ('43', 'diegoprogenio@gmail.com', '$2y$10$17VrFrmWCvPRUpp35zQY/O.kTJLfwbDn.pHCyxh.TAbdHiDX0ys2a', 'Diego Progênio', '69312500', 'RR', 'Boa Vista', 'Rua Santa Maria', '95981053478', '95981053478', NULL, NULL, NULL, NULL, '0', '0', '2025-10-23 17:53:10', '2025-10-23 17:54:56', NULL);
INSERT INTO `users` VALUES ('44', 'pessoal@contabilidadelenz.com.br', '$2y$10$xakdkKIqsPlIG65UWCTrKOd850z3fdpUBxbzNs7LWObXoIrXHNVLu', 'Lurdes Teresinha Hrpp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-10-23 17:53:11', '2025-10-23 17:53:11', NULL);
INSERT INTO `users` VALUES ('45', 'brasilcontabilidade1@gmail.com', '$2y$10$p1Rxuw0UG7u0OHMI02JTdeMxg4DyBNZlUxMvZrN.slTkh7TylmyHS', 'Maria Eline Santana Brasil', '76820099', 'RO', 'Porto Velho', 'Rua Raimundo Cantuária 3039', NULL, '069999657261', NULL, NULL, NULL, 'Serviços contábeis fiscal pessoal tributário e societário', '1', '0', '2025-10-24 09:43:33', '2025-10-24 09:46:09', NULL);
INSERT INTO `users` VALUES ('46', 'caroliny@ilcont.com.br', '$2y$10$BAEH95Bb6yQ/FnBeIz9GUuNuSFSIa3LDdG7MAO3LUROXBeHAT/qLW', 'Carolina weiss', '88160144', 'SC', 'Biguaçu', 'Rua Prefeito Leopoldo Freiberger 22', NULL, '048996186515', NULL, NULL, NULL, 'Serviços contábeis fiscal pessoal tributário e societário', '1', '0', '2025-10-24 11:05:01', '2025-10-24 11:07:07', NULL);
INSERT INTO `users` VALUES ('47', 'ana.tafarel@hinckel.com.br', '$2y$10$qMt0iG0X8XvlAbLUkCOTOOMenvZCqqDiVsy03SVfrEghzmnE.dZCm', 'Ana Paula Tafarel', '95072342', 'RS', 'Caxias do Sul', 'Rua José Tovazzi 419', NULL, '054999367207', NULL, NULL, NULL, 'Serviços contábeis fiscal pessoal tributário e societario', '1', '0', '2025-10-24 11:23:37', '2025-10-24 11:25:34', NULL);
INSERT INTO `users` VALUES ('48', 'gustavo@dahmercontabilidade.com.br', '$2y$10$hyut.DShHkU89INPv3E3VONycgs803VyLSxJhhx.M9gPPhorcK5Ee', 'Jorge Gustavo', '91340000', 'RS', 'Porto Alegre', 'Avenida João Wallig', '51984118722', '519984118722', NULL, NULL, NULL, 'Serviços contabeis fiscal pessoal tributário e societário', '1', '0', '2025-10-24 13:32:40', '2025-10-24 13:34:12', NULL);
INSERT INTO `users` VALUES ('49', 'cmademes@hotmail.com', '$2y$10$XoixGr0f7vdGAGNqA4FSSOVUuITOSmQvdhn7XU9AGTnjTaBIDQNri', 'Claudemir', '69037901', 'AM', 'Manaus', 'Avenida Coronel Teixeira 5803', NULL, '092991127880', NULL, NULL, NULL, NULL, '0', '0', '2025-10-24 13:43:43', '2025-10-24 13:45:04', NULL);
INSERT INTO `users` VALUES ('50', 'clea.silveira@contabilidadeativo.com.br', '$2y$10$CYmdgRy15K6Cwiamx9lPQ.FezoWgr2uJFXD7DzAXzJLN/BTqsy4M6', 'Ativo Assessoria e Planejamento Contabil ltda', '88350350', 'SC', 'Brusque', 'Rua Padre Gatone 20 sl 13', NULL, '04733512240', NULL, NULL, NULL, NULL, '0', '0', '2025-10-24 14:05:41', '2025-10-24 14:06:55', NULL);
INSERT INTO `users` VALUES ('51', 'comercial@vilacontabil.com.br', '$2y$10$7K0tA0ASSBTg3cQVhtCs9.hWm8iyISdbQjtFYvo9pNBMyguZnRTwi', 'paulo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-10-27 15:13:13', '2025-10-27 15:13:13', NULL);
INSERT INTO `users` VALUES ('52', 'teste@teste.com.br', '$2y$10$UMBGWTSQImQaHT00s1Mm6OoKw2gLW5GeZQqPMvDsU4l7wQGXt2YRy', 'teste teste', '13484050', 'SP', 'Limeira', 'Rua Tatuibi 507', '1934525192', '19987166676', NULL, NULL, NULL, 'escritortio de contabilidade', '0', '0', '2025-11-04 16:26:12', '2025-11-04 16:28:17', NULL);
INSERT INTO `users` VALUES ('53', 'gabiel4k12@gmail.com', '$2y$10$JZFaASfX5.bzepuWYj9XeOi179hn11OvVgf5S99g/eY4Nf8QkZEFK', 'Raphael Bellagama Ferracioli', '13060243', 'SP', 'Campinas', 'Rua josé Ramsolem 55', '19995267199', '19995267199', '', 'https://ssd', '', 'sfsdfsdfsd', '1', '0', '2025-11-06 23:32:28', '2025-11-24 14:15:15', 'uploads/avatars/avatar_53_1764004515.webp');
INSERT INTO `users` VALUES ('54', 'raphael.bf@puccampinas.edu.br', '$2y$10$9NGnw4FAmNij4snnWNfvXeIZbFjR3BZPwYfI1sY7RUjqRnsaLWXxC', 'maridalva', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-11-07 00:00:25', '2025-11-07 00:00:25', NULL);
INSERT INTO `users` VALUES ('55', 'teste@uol.com.br', '$2y$10$uyAWPrtj7Q2bcv4C4spgK.OPzOWmvfcFP7GDx0zUTZ3XYoGTdMvMm', 'eee', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-11-07 09:13:26', '2025-11-07 09:13:26', NULL);
INSERT INTO `users` VALUES ('56', 'autoeletrica@gmail.com', '$2y$10$QEBpjCTo.oTw7oRMUdFWOOriioK.hhxdicVwSoYhAJiuRVbF5PxFS', 'MARIDALVA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-11-18 12:20:59', '2025-11-18 12:20:59', NULL);
INSERT INTO `users` VALUES ('57', 'test123@gmail.com', '$2y$10$NbKvh0D2sH7qVhcAWJJ/fuhDw7OvobeoLVRBjJ7rnqj6TqXS/hsmq', 'MARIDALVA BELLAGAMA FERRACIOLI', '13034-685', 'SP', 'Campinas', 'Rua José Rosolem', '19992097002', '19995267199', '', '', '', '', '0', '0', '2025-11-18 12:26:42', '2025-11-18 12:34:57', NULL);
INSERT INTO `users` VALUES ('58', 'teste@gmail.com', '$2y$10$10XWVNR1eBqLoM.ysZrX/.G0Kl9k3miuc08RpS63rFMu6J308J8gW', 'MARIDALVA BELLAGAMA FERRACIOLI', '13034-685', 'SP', 'Campinas', 'Rua José Rosolem', '19992097002', '19995267199', '', '', '', '', '0', '0', '2025-11-18 12:36:56', '2025-11-18 12:37:27', NULL);
INSERT INTO `users` VALUES ('59', 'tst12@gmail.com', '$2y$10$MuAU4MunfdOWLcRNKmRTMekhHWMoxSOCk9ozHMN4vng0yMjYuhMme', 'Raphael Bellagama Ferracioli', '13060222', 'PE', 'Campinas', 'Rua josé Ramsolem 55', '19995267199', '19999424', '', '', '', '', '1', '0', '2025-11-19 09:05:38', '2025-11-19 09:54:41', NULL);
INSERT INTO `users` VALUES ('60', 'test4@gmail.com', '$2y$10$P5KONsH0ZA2tlAnAB9EiieJV9wlzimEr9AB5UjCxIw/pkEXCURNAW', '123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-11-19 09:15:09', '2025-11-19 09:15:09', NULL);
INSERT INTO `users` VALUES ('61', 'test5@gmail.com', '$2y$10$koB.jbrFLWthkCauzAEb6OGIFA4zNyMneM1G.PVxaCBNicZb4WBWC', 'teste', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-11-19 09:26:39', '2025-11-19 09:26:39', NULL);
INSERT INTO `users` VALUES ('62', 'teste50@gmail.com', '$2y$10$y1J.37ekXRn8ffJ/9S73peDcwxGYK7NmEu/27.Np8EoD9sS6xxeGK', 'Raphael Bellagama Ferracioli', '13060222', 'PI', 'Campinas', 'Rua josé Ramsolem 55', '123456', '123456', '', '', '', '', '1', '0', '2025-11-19 10:04:47', '2025-11-19 10:05:25', NULL);
INSERT INTO `users` VALUES ('63', 'paulo@contadoresassociados.com.br', '$2y$10$uRmPCtCmBzeSHD3vDIsgDORnFK/Uks4JKNZfL6jkUHFGITPQ1ilAm', 'Contadores Associados', '13484050', 'SP', 'Limeira', 'Rua Tatuibi, 507, Vila Paulista', '19 3452-5192', '19 98716-6676', '', '', '', '', '1', '0', '2025-11-19 18:02:52', '2025-11-19 18:03:56', NULL);
INSERT INTO `users` VALUES ('64', 'teste1@teste.com.br', '$2y$10$fnNUwsNRw7cpo.QSasp6Su.5wbnXtJNwcT5LE6yV9N3czT637Ua6S', 'Teste contabil', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-11-19 18:08:21', '2025-11-19 18:08:21', NULL);
INSERT INTO `users` VALUES ('65', 'teste@123.com', '$2y$10$SWOVPUm.8vJ5jiS6qjj2M.1FghHXULhcPUwQ009TKc1pcsCWNLoLa', 'Raphael Bellagama Ferracioli', '13060222', 'RO', 'Campinas', 'Rua josé Ramsolem 55', '19995267199', '19995267199', '', '', '', 'Nova descrição', '1', '0', '2025-11-19 23:37:01', '2025-11-19 23:41:40', NULL);
INSERT INTO `users` VALUES ('66', 'string09@gmail.com', '$2y$10$p9adhuTBGeIAsykwxUlP8umHuBGH8xrY.RpQoWYQhEzDU.qg.eyL.', 'Raphael Bellagama Ferracioli', '13060222', 'SP', 'Campinas', 'Rua josé Ramsolem 55', '19995267199', '4455', '', '', '', '', '1', '0', '2025-11-20 21:28:00', '2025-11-20 21:28:18', NULL);
INSERT INTO `users` VALUES ('67', 'test12@gmail.com', '$2y$10$0jlbq7gxtyQkqRpon3HeQu2dSISMHcaoEcbFIyEt9pghChlzsChUy', 'Raphael Bellagama Ferracioli', '13060243', 'SP', 'campinas', 'rua jose ramsolem 55', '19995267199', '19995267199', '', '', '', '', '1', '0', '2025-11-24 11:24:17', '2025-11-24 11:25:42', NULL);
INSERT INTO `users` VALUES ('68', 'test13@gmail.com', '$2y$10$lpUG9YiSr9UfBrVkmWaouO2N7jfDHpm3dvgmfP2dnXlLOx13tztUO', 'Raphael Bellagama Ferracioli', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-11-24 11:28:49', '2025-11-24 11:28:49', NULL);
INSERT INTO `users` VALUES ('69', 'test14@gmail.com', '$2y$10$8hrBHqnMz2Gtpekt.oaCEeF7ZmOqtKz0El1FWVfl.D9ZIS0VJlqfy', 'Raphael Bellagama Ferracioli', '13060222', 'SP', 'Campinas', 'Rua josé Ramsolem 55', '19995267199', '19995267199', 'https://ssd', '', '', 'qualquer coisas', '1', '0', '2025-11-24 11:38:14', '2025-11-24 11:38:56', NULL);
INSERT INTO `users` VALUES ('70', 'test90@gmail.com', '$2y$10$tq1WLwT5Niswj/Zw8K2FC.vQtePnU2F9jDjPKE5T2x2Y8tdIsdv7C', 'test90', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-11-24 12:32:16', '2025-11-24 12:32:16', NULL);
INSERT INTO `users` VALUES ('71', 'test133@gmail.com', '$2y$10$waSOmojO/Z82TwEaHTfBPu3M0ctBurk7bIDMV0px9bGCrnjgNbRqO', 'Raphael Bellagama Ferracioli', '13060222', 'PI', 'Campinas', 'Rua josé Ramsolem 55', '19995267199', '199995267199', '', '', '', '', '1', '0', '2025-11-24 14:13:10', '2025-11-24 14:13:33', 'uploads/avatars/avatar_71_1764004413.png');
INSERT INTO `users` VALUES ('72', 'string10@gmail.com', '$2y$10$FbBm4chG7MDRaed3lebnP.G1bgDjeE6vWC8VxKiLCUswiWiNojC1G', 'Raphael Bellagama Ferracioli', '13060222', 'SP', 'Campinas', 'Rua josé Ramsolem 55', '19995267199', '324543543', '', '', '', '', '1', '0', '2025-11-24 14:15:46', '2025-11-24 14:16:11', 'uploads/avatars/avatar_72_1764004571.png');
INSERT INTO `users` VALUES ('73', 'leoemassa100@gmail.com', '$2y$10$SDD9JFEaMNIGnP/rvF/uZOBTnYsfXQXQ.fvMgQmnyQs4Qc.5c4HI6', 'Leonardo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-11-24 20:22:43', '2025-11-24 20:22:43', NULL);
INSERT INTO `users` VALUES ('74', 'leonardo@gmail.com', '$2b$10$IK3sXNr4SU0PeG77o39R3OKl9CRK8TMFf5NcI/EjmK0BHLC2TzjYO', 'leonardo', NULL, NULL, NULL, NULL, '19981781399', NULL, NULL, NULL, NULL, NULL, '0', '0', '2025-11-24 21:25:54', '2025-11-24 21:25:54', NULL);

