<?php
require_once __DIR__ . '/../helpers.php';
require_once __DIR__ . '/../repositories/product-repository.php';

function getProductRequest(array $request): array
{
    return [
        'id' => requestText($request, 'id'),
        'product_code' => requestText($request, 'product_code'),
        'product_name' => requestText($request, 'product_name'),
        'category' => requestText($request, 'category'),
        'unit' => requestText($request, 'unit'),
        'price' => requestText($request, 'price'),
        'stock' => requestText($request, 'stock'),
        'entry_date' => requestText($request, 'entry_date'),
        'description' => requestText($request, 'description'),
    ];
}

function validateProduct(array $request, $ignoreId = 0): array
{
    $errors = [];
    $categories = ['Food', 'Drink', 'Stationery', 'Uniform'];
    $units = ['Pcs', 'Pack', 'Bottle'];

    if ($request['product_code'] === '') {
        $errors['product_code'] = 'Kode produk wajib diisi.';
    } elseif (strlen($request['product_code']) > 10) {
        $errors['product_code'] = 'Kode produk maksimal 10 karakter.';
    } elseif (isProductCodeTaken($request['product_code'], $ignoreId)) {
        $errors['product_code'] = 'Kode produk sudah digunakan.';
    }

    if ($request['product_name'] === '') {
        $errors['product_name'] = 'Nama produk wajib diisi.';
    } elseif (mbLen($request['product_name']) > 100) {
        $errors['product_name'] = 'Nama produk maksimal 100 karakter.';
    }

    if ($request['category'] === '') {
        $errors['category'] = 'Kategori wajib dipilih.';
    } elseif (!in_array($request['category'], $categories, true)) {
        $errors['category'] = 'Pilihan kategori tidak valid.';
    }

    if ($request['unit'] === '') {
        $errors['unit'] = 'Satuan wajib dipilih.';
    } elseif (!in_array($request['unit'], $units, true)) {
        $errors['unit'] = 'Pilihan satuan tidak valid.';
    }

    if ($request['price'] === '') {
        $errors['price'] = 'Harga wajib diisi.';
    } elseif (!preg_match('/^\d+(\.\d{1,2})?$/', $request['price']) || (float) $request['price'] > 99999999.99) {
        $errors['price'] = 'Harga harus berupa angka maksimal 2 desimal dan sesuai batas kolom.';
    }

    if ($request['stock'] === '') {
        $errors['stock'] = 'Stok wajib diisi.';
    } elseif (
        filter_var($request['stock'], FILTER_VALIDATE_INT) === false
        || (int) $request['stock'] < 0
        || (int) $request['stock'] > 2147483647
    ) {
        $errors['stock'] = 'Stok harus bilangan bulat dan tidak boleh negatif.';
    }

    if ($request['entry_date'] === '') {
        $errors['entry_date'] = 'Tanggal masuk wajib diisi.';
    } elseif (!isValidDateValue($request['entry_date'])) {
        $errors['entry_date'] = 'Tanggal masuk tidak valid.';
    }

    // Deskripsi dibuat opsional karena berfungsi sebagai keterangan tambahan.
    return $errors;
}

function mbLen(string $value): int
{
    return function_exists('mb_strlen') ? mb_strlen($value, 'UTF-8') : strlen($value);
}
