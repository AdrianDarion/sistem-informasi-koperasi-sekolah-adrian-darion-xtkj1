<?php
require_once __DIR__ . '/../../helpers.php';
require_once __DIR__ . '/../../validations/product-validation.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../pages/products/index.php');
    exit;
}

$request = getProductRequest($_POST);
$errors = validateProduct($request);
if ($errors) {
    flashRedirect('../../pages/products/create.php', $errors, $request);
}

try {
    global $pdo;
    $sql = 'INSERT INTO products (product_code, product_name, category, unit, price, stock, entry_date, description)
            VALUES (:product_code, :product_name, :category, :unit, :price, :stock, :entry_date, :description)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'product_code' => $request['product_code'],
        'product_name' => $request['product_name'],
        'category' => $request['category'],
        'unit' => $request['unit'],
        'price' => $request['price'],
        'stock' => $request['stock'],
        'entry_date' => $request['entry_date'],
        'description' => $request['description'],
    ]);
    flashRedirect('../../pages/products/index.php', [], [], 'Produk berhasil ditambahkan.');
} catch (PDOException $error) {
    $message = $error->getCode() === '23000'
                ? 'Kode produk sudah digunakan.'
                : 'Produk gagal disimpan. Periksa koneksi dan struktur tabel.';
    flashRedirect('../../pages/products/create.php', ['general' => $message], $request);
}
