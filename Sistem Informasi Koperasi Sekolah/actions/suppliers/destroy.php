<?php
require_once __DIR__ . '/../../helpers.php';
require_once __DIR__ . '/../../repositories/supplier-repository.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../pages/suppliers/index.php');
    exit;
}

$id = (int) ($_POST['id'] ?? 0);
if ($id < 1 || !isSupplierExists($id)) {
    flashRedirect('../../pages/suppliers/index.php', ['general' => 'Data supplier tidak ditemukan.']);
}

try {
    global $pdo;
    $stmt = $pdo->prepare('DELETE FROM suppliers WHERE supplier_id = :id');
    $stmt->execute(['id' => $id]);
    flashRedirect('../../pages/suppliers/index.php', [], [], 'Supplier berhasil dihapus.');
} catch (PDOException $error) {
    flashRedirect('../../pages/suppliers/index.php', ['general' => 'Supplier gagal dihapus.']);
}
