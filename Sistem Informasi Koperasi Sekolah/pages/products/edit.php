<?php
require_once __DIR__ . '/../../helpers.php';
require_once __DIR__ . '/../../repositories/product-repository.php';
$product = getProduct($_GET['id'] ?? 0);
if (!$product) { flashRedirect('index.php', ['general' => 'Data produk tidak ditemukan.']); }
$errors = takeFlash('errors');
$old = takeFlash('old');
$data = array_merge($product, $old);
$pageTitle = 'Edit Produk';
$pageSubtitle = 'Perbarui informasi barang koperasi.';
$categories = ['Food', 'Drink', 'Stationery', 'Uniform'];
$units = ['Pcs', 'Pack', 'Bottle'];
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Produk</title>
        <link rel="stylesheet" href="../../styles/app.css">
    </head>
    <body>
        <div class="app-layout">
            <?php require __DIR__ . '/../../components/sidebar.php'; ?>
            <main class="main-area">
                <?php require __DIR__ . '/../../components/topbar.php'; ?>
                <section class="content-area">
                    <form class="form-card" method="POST" action="../../actions/products/update.php">
                        <input type="hidden" name="id" value="<?= (int) $product['product_id'] ?>">
                        <?php if (!empty($errors['general'])): ?>
                            <div class="alert alert-error full-field"><?= e($errors['general']) ?></div>
                        <?php endif; ?>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="product_code">Kode Produk *</label>
                                <input id="product_code" name="product_code" type="text" maxlength="10" required value="<?= e($data['product_code'] ?? '') ?>">
                                <?php if (!empty($errors['product_code'])): ?>
                                    <small class="error-text"><?= e($errors['product_code']) ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="product_name">Nama Produk *</label>
                                <input id="product_name" name="product_name" type="text" maxlength="100" required value="<?= e($data['product_name'] ?? '') ?>">
                                <?php if (!empty($errors['product_name'])): ?>
                                    <small class="error-text"><?= e($errors['product_name']) ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="category">Kategori *</label>
                                <select id="category" name="category" required>
                                    <option value="">Pilih kategori</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= e($category) ?>" <?= ($data['category'] ?? '') === $category ? 'selected' : '' ?>><?= e($category) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (!empty($errors['category'])): ?>
                                    <small class="error-text"><?= e($errors['category']) ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label>Satuan *</label>
                                <div class="choice-row">
                                    <?php foreach ($units as $unit): ?>
                                        <label class="choice">
                                            <input type="radio" name="unit" value="<?= e($unit) ?>" required <?= ($data['unit'] ?? '') === $unit ? 'checked' : '' ?>>
                                            <?= e($unit) ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                                <?php if (!empty($errors['unit'])): ?>
                                    <small class="error-text"><?= e($errors['unit']) ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="price">Harga (Rp) *</label>
                                <input id="price" name="price" type="number" min="0" step="0.01" required value="<?= e($data['price'] ?? '') ?>">
                                <?php if (!empty($errors['price'])): ?>
                                    <small class="error-text"><?= e($errors['price']) ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="stock">Stok *</label>
                                <input id="stock" name="stock" type="number" min="0" step="1" required value="<?= e($data['stock'] ?? '') ?>">
                                <?php if (!empty($errors['stock'])): ?>
                                    <small class="error-text"><?= e($errors['stock']) ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="entry_date">Tanggal Masuk *</label>
                                <input id="entry_date" name="entry_date" type="date" required value="<?= e($data['entry_date'] ?? '') ?>">
                                <?php if (!empty($errors['entry_date'])): ?>
                                    <small class="error-text"><?= e($errors['entry_date']) ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="form-group full-field">
                                <label for="description">Deskripsi</label>
                                <textarea id="description" name="description" rows="4"><?= e($data['description'] ?? '') ?></textarea>
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
