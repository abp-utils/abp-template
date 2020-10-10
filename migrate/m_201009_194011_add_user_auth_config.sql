ALTER TABLE `user` ADD `email` varchar(255) NOT NULL AFTER `username`;
ALTER TABLE `user` ADD `token` varchar(255) NOT NULL AFTER `role`;
ALTER TABLE `user` ADD `token_confirm` varchar(255) NOT NULL AFTER `token`;
ALTER TABLE `user` ADD `is_confirm` int(1) NOT NULL DEFAULT 0 AFTER `token_confirm`;
ALTER TABLE `user` ADD `is_active` int(1) NOT NULL DEFAULT 0 AFTER `is_confirm`;
ALTER TABLE `user` ADD `created_time` int(11) NOT NULL;
ALTER TABLE `user` ADD `updated_time` int(11) NULL DEFAULT NULL;
ALTER TABLE `user` ADD UNIQUE(`email`);
ALTER TABLE `user` ADD UNIQUE(`hash`);
ALTER TABLE `user` ADD UNIQUE(`token`);
ALTER TABLE `user` ADD UNIQUE(`token_confirm`);

CREATE TABLE IF NOT EXISTS `user_session` (
  `user_session_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `user_agent` text NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 0,
  `challenge_code` int(11) NULL DEFAULT NULL,
  `created_time` int(11) NOT NULL,
  `updated_time` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`user_session_id`),
  UNIQUE KEY `unique_session` (`user_id`, `token`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `user_ip` (
  `user_ip_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  PRIMARY KEY (`user_ip_id`),
  UNIQUE KEY `unique_user_ip` (`user_id`, `ip`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;