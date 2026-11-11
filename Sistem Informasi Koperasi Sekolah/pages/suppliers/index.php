<?php
require_once __DIR__ . '/../../helpers.php';
require_once __DIR__ . '/../../repositories/supplier-repository.php';
$suppliers = getSuppliers();
$errors = takeFlash('errors');
$success = takeFlash('success', '');
$pageTitle = 'Data Suppliers';
$pageSubtitle = 'Kelola informasi pemasok koperasi sekolah.';
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Suppliers - Koperasi Sekolah</title>
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
                            <h2>Daftar Supplier</h2>
                            <p>Informasi pemasok dan jenis produk yang disediakan.</p>
                        </div>
                        <a class="btn btn-primary" href="create.php">+ Tambah Supplier</a>
                    </div>
                    <div class="table-card">
                        <div class="table-wrap">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Nama Supplier</th>
                                        <th>Email</th>
                                        <th>Telepon</th>
                                        <th>Jenis Produk</th>
                                        <th>Tanggal Kerja Sama</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!$suppliers): ?>
                                        <tr>
                                            <td colspan="6" class="empty">Belum ada data supplier.</td>
                                        </tr>
                                        <?php else: ?>
                                        <?php foreach ($suppliers as $supplier): ?>
                                            <?php
                                                $types = json_decode($supplier['product_types'] ?? '[]', true);
                                                if (!is_array($types)) {
                                                    $types = [];
                                                }
                                                ?>
                                            <tr>
                                                <td>
                                                    <strong><?= e($supplier['supplier_name']) ?></strong>
                                                    <small class="cell-sub"><?= e($supplier['address']) ?></small>
                                                </td>
                                                <td><?= e($supplier['email']) ?></td>
                                                <td><?= e($supplier['phone']) ?></td>
                                                <td>
                                                    <div class="tag-list">
                                                        <?php foreach ($types as $type): ?>
                                                            <span class="tag"><?= e($type) ?></span>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </td>
                                                <td><?= e($supplier['partnership_date']) ?></td>
                                                <td>
                                                    <div class="actions">
                                                        <a class="btn btn-small btn-light" href="edit.php?id=<?= (int) $supplier['supplier_id'] ?>">Edit</a>
                                                        <form method="POST" action="../../actions/suppliers/destroy.php" onsubmit="return confirm('Yakin ingin menghapus supplier ini?')">
                                                            <input type="hidden" name="id" value="<?= (int) $supplier['supplier_id'] ?>">
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
