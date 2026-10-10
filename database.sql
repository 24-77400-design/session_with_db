
CREATE DATABASE IF NOT EXISTS `school_login_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `school_login_db`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `full_name` VARCHAR(100) NOT NULL,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('admin','student') NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `users` (`full_name`, `username`, `password`, `role`)
VALUES
  ('System Administrator', 'admin', '$2y$12$Bjx.eBf5X0CFr0E4e5FGEejwgJDYYHFachZuE7PjJSgCDrV2RIkl.', 'admin'),
  ('Second Administrator', 'admin2', '$2y$12$Bq.y8sKGv4d.uIWsvy8K.e4XjeYHffZsHKCTJIgM9HaHlQxhm1pgK', 'admin'),
  ('Student One', 'student1', '$2y$12$kpAjsMtpcwKzf8bYD3Xc/OgytciwRW8FR03T2KT0a3cJC2VWeffAS', 'student'),
  ('Student Two', 'student2', '$2y$12$sI7VS2d4xIjNUp5/vQqweOJ6xSAsk4K/sp1aFayhjjWJCmFaDc7Ae', 'student')
ON DUPLICATE KEY UPDATE `username` = VALUES(`username`);
