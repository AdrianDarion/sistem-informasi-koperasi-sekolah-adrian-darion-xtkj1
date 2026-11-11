<?php
require_once __DIR__ . '/../config/database.php';

function getProducts(): array
{
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM products ORDER BY product_id DESC');
    $stmt->execute();
    return $stmt->fetchAll();
}

function getProduct($id)
{
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM products WHERE product_id = :id');
    $stmt->execute(['id' => (int) $id]);
    return $stmt->fetch() ?: false;
}

function isProductExists($id): bool
{
    global $pdo;
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM products WHERE product_id = :id');
    $stmt->execute(['id' => (int) $id]);
    return (int) $stmt->fetchColumn() > 0;
}

function isProductCodeTaken(string $code, $ignoreId = 0): bool
{
    global $pdo;
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM products WHERE product_code = :code AND product_id != :id');
    $stmt->execute(['code' => $code, 'id' => (int) $ignoreId]);
    return (int) $stmt->fetchColumn() > 0;
}
