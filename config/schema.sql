CREATE DATABASE IF NOT EXISTS tattoo_studio CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE tattoo_studio;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created DATETIME NULL,
    modified DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS tattoos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NULL,
    description TEXT NULL,
    image_path VARCHAR(500) NOT NULL,
    created DATETIME NULL,
    modified DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


