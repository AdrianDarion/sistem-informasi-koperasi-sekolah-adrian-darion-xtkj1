<?php
require_once __DIR__ . '/../../helpers.php';
require_once __DIR__ . '/../../validations/supplier-validation.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../pages/suppliers/index.php');
    exit;
}

$request = getSupplierRequest($_POST);
$errors = validateSupplier($request);
if ($errors) {
    flashRedirect('../../pages/suppliers/create.php', $errors, $request);
}

try {
    global $pdo;
    $sql = 'INSERT INTO suppliers (supplier_name, email, phone, address, product_types, partnership_date)
            VALUES (:supplier_name, :email, :phone, :address, :product_types, :partnership_date)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'supplier_name' => $request['supplier_name'],
        'email' => $request['email'],
        'phone' => $request['phone'],
        'address' => $request['address'],
        'product_types' => json_encode($request['product_types'], JSON_UNESCAPED_UNICODE),
        'partnership_date' => $request['partnership_date'],
    ]);
    flashRedirect('../../pages/suppliers/index.php', [], [], 'Supplier berhasil ditambahkan.');
} catch (PDOException $error) {
    flashRedirect('../../pages/suppliers/create.php', ['general' => 'Supplier gagal disimpan. Periksa koneksi dan struktur tabel.'], $request);
}
