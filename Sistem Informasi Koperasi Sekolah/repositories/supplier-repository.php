<?php
require_once __DIR__ . '/../config/database.php';

function getSuppliers(): array
{
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM suppliers ORDER BY supplier_id DESC');
    $stmt->execute();
    return $stmt->fetchAll();
}

function getSupplier($id)
{
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM suppliers WHERE supplier_id = :id');
    $stmt->execute(['id' => (int) $id]);
    return $stmt->fetch() ?: false;
}

function isSupplierExists($id): bool
{
    global $pdo;
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM suppliers WHERE supplier_id = :id');
    $stmt->execute(['id' => (int) $id]);
    return (int) $stmt->fetchColumn() > 0;
}
