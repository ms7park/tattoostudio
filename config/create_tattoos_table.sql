-- tattoos 테이블 생성
USE bunyang2_godohosting_com;

CREATE TABLE IF NOT EXISTS tattoos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NULL,
    description TEXT NULL,
    image_path VARCHAR(500) NOT NULL,
    created DATETIME NULL,
    modified DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

