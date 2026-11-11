<?php
require_once __DIR__ . '/../config/database.php';

function getEmployees(): array
{
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM employees ORDER BY employee_id DESC');
    $stmt->execute();
    return $stmt->fetchAll();
}

function getEmployee($id)
{
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM employees WHERE employee_id = :id');
    $stmt->execute(['id' => (int) $id]);
    return $stmt->fetch() ?: false;
}

function isEmployeeExists($id): bool
{
    global $pdo;
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM employees WHERE employee_id = :id');
    $stmt->execute(['id' => (int) $id]);
    return (int) $stmt->fetchColumn() > 0;
}

function isEmployeeNumberTaken(string $number, $ignoreId = 0): bool
{
    global $pdo;
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM employees WHERE employee_number = :number AND employee_id != :id');
    $stmt->execute(['number' => $number, 'id' => (int) $ignoreId]);
    return (int) $stmt->fetchColumn() > 0;
}
