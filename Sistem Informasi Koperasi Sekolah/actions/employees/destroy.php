<?php
require_once __DIR__ . '/../../helpers.php';
require_once __DIR__ . '/../../repositories/employee-repository.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../pages/employees/index.php');
    exit;
}

$id = (int) ($_POST['id'] ?? 0);
if ($id < 1 || !isEmployeeExists($id)) {
    flashRedirect('../../pages/employees/index.php', ['general' => 'Data pegawai tidak ditemukan.']);
}

try {
    global $pdo;
    $stmt = $pdo->prepare('DELETE FROM employees WHERE employee_id = :id');
    $stmt->execute(['id' => $id]);
    flashRedirect('../../pages/employees/index.php', [], [], 'Data pegawai berhasil dihapus.');
} catch (PDOException $error) {
    flashRedirect('../../pages/employees/index.php', ['general' => 'Data pegawai gagal dihapus.']);
}
