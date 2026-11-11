<?php
require_once __DIR__ . '/../helpers.php';
require_once __DIR__ . '/../repositories/employee-repository.php';

function getEmployeeRequest(array $request): array
{
    return [
        'id' => requestText($request, 'id'),
        'employee_number' => requestText($request, 'employee_number'),
        'full_name' => requestText($request, 'full_name'),
        'gender' => requestText($request, 'gender'),
        'birth_date' => requestText($request, 'birth_date'),
        'position' => requestText($request, 'position'),
        'salary' => requestText($request, 'salary'),
    ];
}

function validateEmployee(array $request, $ignoreId = 0): array
{
    $errors = [];
    $genders = ['M', 'F'];
    $positions = ['Cashier', 'Warehouse Staff', 'Admin'];

    if ($request['employee_number'] === '') {
        $errors['employee_number'] = 'Nomor pegawai wajib diisi.';
    } elseif (strlen($request['employee_number']) > 10) {
        $errors['employee_number'] = 'Nomor pegawai maksimal 10 karakter.';
    } elseif (isEmployeeNumberTaken($request['employee_number'], $ignoreId)) {
        $errors['employee_number'] = 'Nomor pegawai sudah digunakan.';
    }

    if ($request['full_name'] === '') {
        $errors['full_name'] = 'Nama lengkap wajib diisi.';
    } elseif (
        function_exists('mb_strlen')
            ? mb_strlen($request['full_name'], 'UTF-8') > 100
            : strlen($request['full_name']) > 100
    ) {
        $errors['full_name'] = 'Nama lengkap maksimal 100 karakter.';
    }

    if (!in_array($request['gender'], $genders, true)) {
        $errors['gender'] = 'Jenis kelamin wajib dipilih.';
    }

    if ($request['birth_date'] === '') {
        $errors['birth_date'] = 'Tanggal lahir wajib diisi.';
    } elseif (!isValidDateValue($request['birth_date'])) {
        $errors['birth_date'] = 'Tanggal lahir tidak valid.';
    }

    if (!in_array($request['position'], $positions, true)) {
        $errors['position'] = 'Jabatan wajib dipilih sesuai pilihan.';
    }

    if ($request['salary'] === '') {
        $errors['salary'] = 'Gaji wajib diisi.';
    } elseif (!preg_match('/^\d+(\.\d{1,2})?$/', $request['salary']) || (float) $request['salary'] > 9999999999.99) {
        $errors['salary'] = 'Gaji harus berupa angka maksimal 2 desimal dan tidak negatif.';
    }

    return $errors;
}
