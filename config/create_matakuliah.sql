-- 1. Buat database
CREATE DATABASE IF NOT EXISTS display_rooms;
USE display_rooms;

-- 2. Buat tabel matakuliah
CREATE TABLE IF NOT EXISTS matakuliah (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode VARCHAR(10) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    sks TINYINT NOT NULL CHECK (sks BETWEEN 1 AND 6),
    semester TINYINT NOT NULL CHECK (semester BETWEEN 1 AND 6),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
