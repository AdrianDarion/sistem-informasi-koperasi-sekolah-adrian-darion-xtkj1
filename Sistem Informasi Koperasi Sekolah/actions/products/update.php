<?php
require_once __DIR__ . '/../../helpers.php';
require_once __DIR__ . '/../../validations/product-validation.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../pages/products/index.php');
    exit;
}

$request = getProductRequest($_POST);
$id = (int) $request['id'];
if ($id < 1 || !isProductExists($id)) {
    flashRedirect('../../pages/products/index.php', ['general' => 'Data produk tidak ditemukan.']);
}

$errors = validateProduct($request, $id);
if ($errors) {
    flashRedirect('../../pages/products/edit.php?id=' . $id, $errors, $request);
}

try {
    global $pdo;
    $sql = 'UPDATE products SET product_code = :product_code, product_name = :product_name,
            category = :category, unit = :unit, price = :price, stock = :stock,
            entry_date = :entry_date, description = :description WHERE product_id = :id';
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
        'id' => $id,
    ]);
    flashRedirect('../../pages/products/index.php', [], [], 'Produk berhasil diperbarui.');
} catch (PDOException $error) {
    $message = $error->getCode() === '23000'
                ? 'Kode produk sudah digunakan.'
                : 'Produk gagal diperbarui. Periksa koneksi dan struktur tabel.';
    flashRedirect('../../pages/products/edit.php?id=' . $id, ['general' => $message], $request);
}
