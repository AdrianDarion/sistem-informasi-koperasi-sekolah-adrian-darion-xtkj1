<?php
require_once __DIR__ . '/../../helpers.php';
require_once __DIR__ . '/../../validations/supplier-validation.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../pages/suppliers/index.php');
    exit;
}

$request = getSupplierRequest($_POST);
$id = (int) $request['id'];
if ($id < 1 || !isSupplierExists($id)) {
    flashRedirect('../../pages/suppliers/index.php', ['general' => 'Data supplier tidak ditemukan.']);
}

$errors = validateSupplier($request);
if ($errors) {
    flashRedirect('../../pages/suppliers/edit.php?id=' . $id, $errors, $request);
}

try {
    global $pdo;
    $sql = 'UPDATE suppliers SET supplier_name = :supplier_name, email = :email, phone = :phone,
            address = :address, product_types = :product_types, partnership_date = :partnership_date
            WHERE supplier_id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'supplier_name' => $request['supplier_name'],
        'email' => $request['email'],
        'phone' => $request['phone'],
        'address' => $request['address'],
        'product_types' => json_encode($request['product_types'], JSON_UNESCAPED_UNICODE),
        'partnership_date' => $request['partnership_date'],
        'id' => $id,
    ]);
    flashRedirect('../../pages/suppliers/index.php', [], [], 'Supplier berhasil diperbarui.');
} catch (PDOException $error) {
    flashRedirect('../../pages/suppliers/edit.php?id=' . $id, ['general' => 'Supplier gagal diperbarui. Periksa koneksi dan struktur tabel.'], $request);
}
