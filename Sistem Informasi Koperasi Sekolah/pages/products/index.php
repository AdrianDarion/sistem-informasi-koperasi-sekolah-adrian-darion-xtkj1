<?php
require_once __DIR__ . '/../../helpers.php';
require_once __DIR__ . '/../../repositories/product-repository.php';
$products = getProducts();
$errors = takeFlash('errors');
$success = takeFlash('success', '');
$pageTitle = 'Data Products';
$pageSubtitle = 'Kelola daftar barang koperasi sekolah.';
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Products - Koperasi Sekolah</title>
        <link rel="stylesheet" href="../../styles/app.css">
    </head>
    <body>
        <div class="app-layout">
            <?php require __DIR__ . '/../../components/sidebar.php'; ?>
            <main class="main-area">
                <?php require __DIR__ . '/../../components/topbar.php'; ?>
                <section class="content-area">
                    <?php if ($success): ?>
                        <div class="alert alert-success"><?= e($success) ?></div>
                    <?php endif; ?>
                    <?php if (!empty($errors['general'])): ?>
                        <div class="alert alert-error"><?= e($errors['general']) ?></div>
                    <?php endif; ?>
                    <div class="section-heading">
                        <div>
                            <h2>Daftar Produk</h2>
                            <p>Data barang yang dijual di koperasi.</p>
                        </div>
                        <a class="btn btn-primary" href="create.php">+ Tambah Produk</a>
                    </div>
                    <div class="table-card">
                        <div class="table-wrap">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Satuan</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!$products): ?>
                                        <tr>
                                            <td colspan="8" class="empty">Belum ada data produk.</td>
                                        </tr>
                                        <?php else: ?>
                                        <?php foreach ($products as $product): ?>
                                            <tr>
                                                <td>
                                                    <span class="code-pill"><?= e($product['product_code']) ?></span>
                                                </td>
                                                <td>
                                                    <strong><?= e($product['product_name']) ?></strong>
                                                    <small class="cell-sub"><?= e($product['description']) ?></small>
                                                </td>
                                                <td><?= e($product['category']) ?></td>
                                                <td><?= e($product['unit']) ?></td>
                                                <td>Rp <?= number_format((float) $product['price'], 0, ',', '.') ?></td>
                                                <td><?= e($product['stock']) ?></td>
                                                <td><?= e($product['entry_date']) ?></td>
                                                <td>
                                                    <div class="actions">
                                                        <a class="btn btn-small btn-light" href="edit.php?id=<?= (int) $product['product_id'] ?>">Edit</a>
                                                        <form method="POST" action="../../actions/products/destroy.php" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                                            <input type="hidden" name="id" value="<?= (int) $product['product_id'] ?>">
                                                            <button class="btn btn-small btn-delete" type="submit">Hapus</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </body>
</html>
