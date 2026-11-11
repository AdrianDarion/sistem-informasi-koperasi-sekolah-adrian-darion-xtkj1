-- Database Sistem Informasi Koperasi Sekolah
-- Jalankan file ini hanya jika database/tabel belum dibuat.
CREATE DATABASE IF NOT EXISTS db_cooperative CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_cooperative;

CREATE TABLE IF NOT EXISTS products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    product_code VARCHAR(10) NOT NULL UNIQUE,
    product_name VARCHAR(100) NOT NULL,
    category ENUM('Food','Drink','Stationery','Uniform') NOT NULL,
    unit ENUM('Pcs','Pack','Bottle') NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL,
    entry_date DATE NOT NULL,
    description TEXT
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS suppliers (
    supplier_id INT AUTO_INCREMENT PRIMARY KEY,
    supplier_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    address TEXT NOT NULL,
    product_types VARCHAR(100) NOT NULL,
    partnership_date DATE NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS employees (
    employee_id INT AUTO_INCREMENT PRIMARY KEY,
    employee_number VARCHAR(10) NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    gender ENUM('M','F') NOT NULL,
    birth_date DATE NOT NULL,
    position ENUM('Cashier','Warehouse Staff','Admin') NOT NULL,
    salary DECIMAL(12,2) NOT NULL
) ENGINE=InnoDB;
