<?php
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/config/database.php';
$productCount = (int) $pdo->query('SELECT COUNT(*) FROM products')->fetchColumn();
$supplierCount = (int) $pdo->query('SELECT COUNT(*) FROM suppliers')->fetchColumn();
$employeeCount = (int) $pdo->query('SELECT COUNT(*) FROM employees')->fetchColumn();
$success = takeFlash('success', '');
$errors = takeFlash('errors');
$loginNotice = takeFlash('login_notice', '');
$pageTitle = 'Dashboard';
$pageSubtitle = 'Ringkasan data master koperasi sekolah. Login di kanan atas hanya opsional.';
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard - Koperasi Sekolah</title>
        <link rel="stylesheet" href="styles/app.css">
    </head>
    <body>
        <div class="app-layout">
            <?php require __DIR__ . '/components/sidebar.php'; ?>
            <main class="main-area">
                <?php require __DIR__ . '/components/topbar.php'; ?>
                <section class="content-area">
                    <?php if ($success): ?>
                        <div class="alert alert-success"><?= e($success) ?></div>
                    <?php endif; ?>
                    <?php if ($loginNotice !== ''): ?>
                        <div class="alert alert-info"><?= e($loginNotice) ?></div>
                    <?php endif; ?>
                    <?php if (!empty($errors['general'])): ?>
                        <div class="alert alert-error"><?= e($errors['general']) ?></div>
                    <?php endif; ?>
                    <div class="welcome-panel">
                        <div>
                            <span class="welcome-label">SELAMAT DATANG</span>
                            <h2>Sistem Informasi Koperasi Sekolah</h2>
                            <p>Kelola data barang, pemasok, dan pegawai koperasi melalui satu halaman.</p>
                        </div>
                        <div class="welcome-symbol">K</div>
                    </div>
                    <div class="stats-grid">
                        <a class="stat-card" href="pages/products/index.php">
                            <span class="stat-icon green">▦</span>
                            <span class="stat-label">Total Products</span>
                            <strong><?= $productCount ?></strong>
                            <small>Lihat data barang →</small>
                        </a>
                        <a class="stat-card" href="pages/suppliers/index.php">
                            <span class="stat-icon blue">♧</span>
                            <span class="stat-label">Total Suppliers</span>
                            <strong><?= $supplierCount ?></strong>
                            <small>Lihat data pemasok →</small>
                        </a>
                        <a class="stat-card" href="pages/employees/index.php">
                            <span class="stat-icon orange">♙</span>
                            <span class="stat-label">Total Employees</span>
                            <strong><?= $employeeCount ?></strong>
                            <small>Lihat data pegawai →</small>
                        </a>
                    </div>
                    <div class="section-heading">
                        <div>
                            <h2>Menu Pengelolaan</h2>
                            <p>Pilih tabel yang ingin dikelola.</p>
                        </div>
                    </div>
                    <div class="quick-grid">
                        <a class="quick-card" href="pages/products/index.php">
                            <span>▦</span>
                            <div>
                                <strong>Products</strong>
                                <small>Tambah, lihat, ubah, dan hapus data produk.</small>
                            </div>
                            <b>→</b>
                        </a>
                        <a class="quick-card" href="pages/suppliers/index.php">
                            <span>♧</span>
                            <div>
                                <strong>Suppliers</strong>
                                <small>Kelola informasi pemasok dan jenis produk.</small>
                            </div>
                            <b>→</b>
                        </a>
                        <a class="quick-card" href="pages/employees/index.php">
                            <span>♙</span>
                            <div>
                                <strong>Employees</strong>
                                <small>Kelola data pegawai koperasi.</small>
                            </div>
                            <b>→</b>
                        </a>
                    </div>
                </section>
            </main>
        </div>
    </body>
</html>
