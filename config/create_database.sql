-- MySQL 8.0 데이터베이스 및 사용자 생성 스크립트

-- 1. 데이터베이스 생성
CREATE DATABASE IF NOT EXISTS `bunyang2_godohosting_com` 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

-- 2. 사용자 생성 (MySQL 8.0 방식)
CREATE USER IF NOT EXISTS 'bunyang2'@'localhost' IDENTIFIED BY 'malsim!@3';

-- 3. 원격 접속을 위한 사용자 생성 (필요한 경우)
CREATE USER IF NOT EXISTS 'bunyang2'@'%' IDENTIFIED BY 'malsim!@3';

-- 4. 데이터베이스에 대한 모든 권한 부여 (localhost)
GRANT ALL PRIVILEGES ON `bunyang2_godohosting_com`.* TO 'bunyang2'@'localhost';

-- 5. 데이터베이스에 대한 모든 권한 부여 (원격 접속, 필요한 경우)
GRANT ALL PRIVILEGES ON `bunyang2_godohosting_com`.* TO 'bunyang2'@'%';

-- 6. 권한 적용
FLUSH PRIVILEGES;

-- 확인 쿼리
-- SHOW DATABASES LIKE 'bunyang2_godohosting_com';
-- SELECT User, Host FROM mysql.user WHERE User='bunyang2';

