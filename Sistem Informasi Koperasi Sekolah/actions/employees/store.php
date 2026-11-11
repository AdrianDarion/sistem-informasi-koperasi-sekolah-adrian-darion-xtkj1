<?php
require_once __DIR__ . '/../../helpers.php';
require_once __DIR__ . '/../../validations/employee-validation.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../pages/employees/index.php');
    exit;
}

$request = getEmployeeRequest($_POST);
$errors = validateEmployee($request);
if ($errors) {
    flashRedirect('../../pages/employees/create.php', $errors, $request);
}

try {
    global $pdo;
    $sql = 'INSERT INTO employees (employee_number, full_name, gender, birth_date, position, salary)
            VALUES (:employee_number, :full_name, :gender, :birth_date, :position, :salary)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'employee_number' => $request['employee_number'],
        'full_name' => $request['full_name'],
        'gender' => $request['gender'],
        'birth_date' => $request['birth_date'],
        'position' => $request['position'],
        'salary' => $request['salary'],
    ]);
    flashRedirect('../../pages/employees/index.php', [], [], 'Pegawai berhasil ditambahkan.');
} catch (PDOException $error) {
    $message = $error->getCode() === '23000'
                ? 'Nomor pegawai sudah digunakan.'
                : 'Pegawai gagal disimpan. Periksa koneksi dan struktur tabel.';
    flashRedirect('../../pages/employees/create.php', ['general' => $message], $request);
}
