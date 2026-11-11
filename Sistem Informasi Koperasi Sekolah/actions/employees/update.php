<?php
require_once __DIR__ . '/../../helpers.php';
require_once __DIR__ . '/../../validations/employee-validation.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../pages/employees/index.php');
    exit;
}

$request = getEmployeeRequest($_POST);
$id = (int) $request['id'];
if ($id < 1 || !isEmployeeExists($id)) {
    flashRedirect('../../pages/employees/index.php', ['general' => 'Data pegawai tidak ditemukan.']);
}

$errors = validateEmployee($request, $id);
if ($errors) {
    flashRedirect('../../pages/employees/edit.php?id=' . $id, $errors, $request);
}

try {
    global $pdo;
    $sql = 'UPDATE employees SET employee_number = :employee_number, full_name = :full_name,
            gender = :gender, birth_date = :birth_date, position = :position, salary = :salary
            WHERE employee_id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'employee_number' => $request['employee_number'],
        'full_name' => $request['full_name'],
        'gender' => $request['gender'],
        'birth_date' => $request['birth_date'],
        'position' => $request['position'],
        'salary' => $request['salary'],
        'id' => $id,
    ]);
    flashRedirect('../../pages/employees/index.php', [], [], 'Data pegawai berhasil diperbarui.');
} catch (PDOException $error) {
    $message = $error->getCode() === '23000'
                ? 'Nomor pegawai sudah digunakan.'
                : 'Pegawai gagal diperbarui. Periksa koneksi dan struktur tabel.';
    flashRedirect('../../pages/employees/edit.php?id=' . $id, ['general' => $message], $request);
}
