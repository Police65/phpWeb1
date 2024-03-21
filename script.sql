CREATE DATABASE IF NOT EXISTS `login_example`;
USE `login_example`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`username`, `password`) VALUES
('usuario1', '$2y$10$eA0AQ5fHlZU2vC5vm61i9u8h7p2lC25DLeXzD.jq4sV3I4ZRUpgQK'); -- Contraseña: password1

ALTER TABLE users MODIFY COLUMN PASSWORD VARCHAR(255) NOT NULL;

CREATE TABLE IF NOT EXISTS `alumnos` (
  `cedula` VARCHAR(20) NOT NULL,
  `nombre` VARCHAR(50),
  `nota1` DECIMAL(5,2),
  `nota2` DECIMAL(5,2),
  `nota3` DECIMAL(5,2),
  `nota4` DECIMAL(5,2),
  `promedio` DECIMAL(5,2),
  PRIMARY KEY (`cedula`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;