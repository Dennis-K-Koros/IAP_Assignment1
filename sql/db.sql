DROP DATABASE IF EXISTS `User details`;
CREATE DATABASE IF NOT EXISTS `User details` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `User details`;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
    `userId` bigint(10) NOT NULL AUTO_INCREMENT,
    `fullname` VARCHAR(50) NOT NULL DEFAULT '',
    `email_address` varchar(50) NOT NULL DEFAULT '',
    `password` varchar(60) NOT NULL DEFAULT '',
    `pass_token` varchar(32) NOT NULL DEFAULT '',
    `pass_token_expire` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`userId`),
    UNIQUE KEY `email_address` (`email_address`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;




