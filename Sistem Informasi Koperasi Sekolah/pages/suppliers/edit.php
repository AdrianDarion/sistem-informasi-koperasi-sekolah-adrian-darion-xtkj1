<?php
require_once __DIR__ . '/../../helpers.php';
require_once __DIR__ . '/../../repositories/supplier-repository.php';
$supplier = getSupplier($_GET['id'] ?? 0);
if (!$supplier) { flashRedirect('index.php', ['general' => 'Data supplier tidak ditemukan.']); }
$errors = takeFlash('errors');
$old = takeFlash('old');
$storedTypes = json_decode($supplier['product_types'] ?? '[]', true);
if (!is_array($storedTypes)) { $storedTypes = []; }
$data = array_merge($supplier, $old);
$selectedTypes = isset($old['product_types']) && is_array($old['product_types']) ? $old['product_types'] : $storedTypes;
$pageTitle = 'Edit Supplier';
$pageSubtitle = 'Perbarui informasi pemasok koperasi.';
$types = ['Food', 'Drink', 'Stationery', 'Uniform'];
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Supplier</title>
        <link rel="stylesheet" href="../../styles/app.css">
    </head>
    <body>
        <div class="app-layout">
            <?php require __DIR__ . '/../../components/sidebar.php'; ?>
            <main class="main-area">
                <?php require __DIR__ . '/../../components/topbar.php'; ?>
                <section class="content-area">
                    <form class="form-card" method="POST" action="../../actions/suppliers/update.php">
                        <input type="hidden" name="id" value="<?= (int) $supplier['supplier_id'] ?>">
                        <?php if (!empty($errors['general'])): ?>
                            <div class="alert alert-error full-field"><?= e($errors['general']) ?></div>
                        <?php endif; ?>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="supplier_name">Nama Supplier *</label>
                                <input id="supplier_name" name="supplier_name" type="text" maxlength="100" required value="<?= e($data['supplier_name'] ?? '') ?>">
                                <?php if (!empty($errors['supplier_name'])): ?>
                                    <small class="error-text"><?= e($errors['supplier_name']) ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input id="email" name="email" type="email" maxlength="100" required value="<?= e($data['email'] ?? '') ?>">
                                <?php if (!empty($errors['email'])): ?>
                                    <small class="error-text"><?= e($errors['email']) ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="phone">Nomor Telepon *</label>
                                <input id="phone" name="phone" type="tel" maxlength="15" required value="<?= e($data['phone'] ?? '') ?>">
                                <?php if (!empty($errors['phone'])): ?>
                                    <small class="error-text"><?= e($errors['phone']) ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="partnership_date">Tanggal Kerja Sama *</label>
                                <input id="partnership_date" name="partnership_date" type="date" required value="<?= e($data['partnership_date'] ?? '') ?>">
                                <?php if (!empty($errors['partnership_date'])): ?>
                                    <small class="error-text"><?= e($errors['partnership_date']) ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="form-group full-field">
                                <label for="address">Alamat *</label>
                                <textarea id="address" name="address" rows="3" required><?= e($data['address'] ?? '') ?></textarea>
                                <?php if (!empty($errors['address'])): ?>
                                    <small class="error-text"><?= e($errors['address']) ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="form-group full-field">
                                <label>Jenis Produk (boleh lebih dari satu) *</label>
                                <div class="choice-row">
                                    <?php foreach ($types as $type): ?>
                                        <label class="choice">
                                            <input type="checkbox" name="product_types[]" value="<?= e($type) ?>" <?= in_array($type, $selectedTypes, true) ? 'checked' : '' ?>>
                                            <?= e($type) ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                                <?php if (!empty($errors['product_types'])): ?>
                                    <small class="error-text"><?= e($errors['product_types']) ?></small>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-actions">
                            <a class="btn btn-light" href="index.php">Kembali</a>
                            <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                        </div>
                    </form>
                </section>
            </main>
        </div>
    </body>
</html>
