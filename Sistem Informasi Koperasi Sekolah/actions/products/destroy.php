<?php
require_once __DIR__ . '/../../helpers.php';
require_once __DIR__ . '/../../repositories/product-repository.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../pages/products/index.php');
    exit;
}

$id = (int) ($_POST['id'] ?? 0);
if ($id < 1 || !isProductExists($id)) {
    flashRedirect('../../pages/products/index.php', ['general' => 'Data produk tidak ditemukan.']);
}

try {
    global $pdo;
    $stmt = $pdo->prepare('DELETE FROM products WHERE product_id = :id');
    $stmt->execute(['id' => $id]);
    flashRedirect('../../pages/products/index.php', [], [], 'Produk berhasil dihapus.');
} catch (PDOException $error) {
    flashRedirect('../../pages/products/index.php', ['general' => 'Produk gagal dihapus.']);
}
