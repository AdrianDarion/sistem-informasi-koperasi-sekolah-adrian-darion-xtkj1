<?php
require_once __DIR__ . '/../../helpers.php';
$errors = takeFlash('errors');
$old = takeFlash('old');
$pageTitle = 'Tambah Supplier';
$pageSubtitle = 'Masukkan informasi pemasok koperasi.';
$types = ['Food', 'Drink', 'Stationery', 'Uniform'];
$selectedTypes = $old['product_types'] ?? [];
if (!is_array($selectedTypes)) { $selectedTypes = []; }
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tambah Supplier</title>
        <link rel="stylesheet" href="../../styles/app.css">
    </head>
    <body>
        <div class="app-layout">
            <?php require __DIR__ . '/../../components/sidebar.php'; ?>
            <main class="main-area">
                <?php require __DIR__ . '/../../components/topbar.php'; ?>
                <section class="content-area">
                    <form class="form-card" method="POST" action="../../actions/suppliers/store.php" >
                        <?php if (!empty($errors['general'])): ?>
                            <div class="alert alert-error full-field"><?= e($errors['general']) ?></div>
                        <?php endif; ?>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="supplier_name">Nama Supplier *</label>
                                <input id="supplier_name" name="supplier_name" type="text" maxlength="100" required value="<?= e($old['supplier_name'] ?? '') ?>">
                                <?php if (!empty($errors['supplier_name'])): ?>
                                    <small class="error-text"><?= e($errors['supplier_name']) ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input id="email" name="email" type="email" maxlength="100" required value="<?= e($old['email'] ?? '') ?>" placeholder="supplier@email.com">
                                <?php if (!empty($errors['email'])): ?>
                                    <small class="error-text"><?= e($errors['email']) ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="phone">Nomor Telepon *</label>
                                <input id="phone" name="phone" type="tel" maxlength="15" required value="<?= e($old['phone'] ?? '') ?>">
                                <?php if (!empty($errors['phone'])): ?>
                                    <small class="error-text"><?= e($errors['phone']) ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="partnership_date">Tanggal Kerja Sama *</label>
                                <input id="partnership_date" name="partnership_date" type="date" required value="<?= e($old['partnership_date'] ?? '') ?>">
                                <?php if (!empty($errors['partnership_date'])): ?>
                                    <small class="error-text"><?= e($errors['partnership_date']) ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="form-group full-field">
                                <label for="address">Alamat *</label>
                                <textarea id="address" name="address" rows="3" required><?= e($old['address'] ?? '') ?></textarea>
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
                            <button class="btn btn-primary" type="submit">Simpan Supplier</button>
                        </div>
                    </form>
                </section>
            </main>
        </div>
    </body>
</html>
