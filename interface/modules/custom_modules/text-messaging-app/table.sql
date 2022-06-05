
CREATE TABLE IF NOT EXISTS `text_message_module` (
`id` int NOT NULL,
`fromnumber` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
`text` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
`date` datetime(6) NOT NULL
);
ALTER TABLE `text_message_module` ADD PRIMARY KEY(`id`);
ALTER TABLE `text_message_module` CHANGE `id` `id` INT NOT NULL AUTO_INCREMENT;
ALTER TABLE `text_message_module` ADD `provider_id` INT(5) NULL AFTER `id`;
