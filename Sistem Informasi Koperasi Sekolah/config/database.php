<?php
// Koneksi database menggunakan PDO, mengikuti pola project BukuKita.
$host = "localhost";
$dbname = "db_cooperative";
$username = "root";
$password = "";

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $error) {
    // Jangan tampilkan detail server database kepada pengguna.
    die("Koneksi database gagal. Periksa Laragon dan pengaturan config/database.php.");
}
