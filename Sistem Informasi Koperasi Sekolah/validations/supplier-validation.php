<?php
require_once __DIR__ . '/../helpers.php';
require_once __DIR__ . '/../repositories/supplier-repository.php';

function getSupplierRequest(array $request): array
{
    return [
        'id' => requestText($request, 'id'),
        'supplier_name' => requestText($request, 'supplier_name'),
        'email' => requestText($request, 'email'),
        'phone' => requestText($request, 'phone'),
        'address' => requestText($request, 'address'),
        'product_types' => requestStringArray($request['product_types'] ?? []),
        'partnership_date' => requestText($request, 'partnership_date'),
    ];
}

function validateSupplier(array $request): array
{
    $errors = [];
    $allowedTypes = ['Food', 'Drink', 'Stationery', 'Uniform'];

    if ($request['supplier_name'] === '') {
        $errors['supplier_name'] = 'Nama supplier wajib diisi.';
    } elseif (
        function_exists('mb_strlen')
            ? mb_strlen($request['supplier_name'], 'UTF-8') > 100
            : strlen($request['supplier_name']) > 100
    ) {
        $errors['supplier_name'] = 'Nama supplier maksimal 100 karakter.';
    }

    if ($request['email'] === '') {
        $errors['email'] = 'Email wajib diisi.';
    } elseif (strlen($request['email']) > 100 || !filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Format email tidak valid atau lebih dari 100 karakter.';
    }

    if ($request['phone'] === '') {
        $errors['phone'] = 'Nomor telepon wajib diisi.';
    } elseif (strlen($request['phone']) > 15) {
        $errors['phone'] = 'Nomor telepon maksimal 15 karakter.';
    }

    if ($request['address'] === '') {
        $errors['address'] = 'Alamat wajib diisi.';
    }

    if (count($request['product_types']) === 0) {
        $errors['product_types'] = 'Pilih minimal satu jenis produk.';
    } else {
        foreach ($request['product_types'] as $type) {
            if (!in_array($type, $allowedTypes, true)) {
                $errors['product_types'] = 'Jenis produk yang dipilih tidak valid.';
                break;
            }
        }
    }

    if ($request['partnership_date'] === '') {
        $errors['partnership_date'] = 'Tanggal kerja sama wajib diisi.';
    } elseif (!isValidDateValue($request['partnership_date'])) {
        $errors['partnership_date'] = 'Tanggal kerja sama tidak valid.';
    }

    return $errors;
}
