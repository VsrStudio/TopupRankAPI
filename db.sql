CREATE DATABASE topuprank;

USE topuprank;

-- Tabel untuk pengguna
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel untuk transaksi
CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    rank VARCHAR(20) NOT NULL,
    status VARCHAR(20) NOT NULL,
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (username) REFERENCES users(username)
);

-- Tambahkan admin default
INSERT INTO users (username, password, role) VALUES 
('admin', '$2y$10$HqvV/Uo5PfT7v6xlGeKPhui.kkKQn.XkgBQnnBoBTcKHb94QH4bsq', 'admin'); -- Password: admin123
