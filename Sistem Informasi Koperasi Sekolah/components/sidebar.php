<?php $basePath = pageBasePath(); ?>
<aside class="sidebar">
    <a class="brand" href="<?= e($basePath) ?>index.php">
        <span class="brand-mark">K</span>
        <span>
            <strong>Koperasi</strong>
            <small>Sekolah</small>
        </span>
    </a>
    <div class="nav-label">MENU UTAMA</div>
    <nav class="nav-menu">
        <a href="<?= e($basePath) ?>index.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'index.php' && strpos($_SERVER['PHP_SELF'], '/pages/') === false ? 'active' : '' ?>">
            <span class="nav-icon">⌂</span>
            Dashboard
        </a>
        <a href="<?= e($basePath) ?>pages/products/index.php" class="nav-link <?= strpos($_SERVER['PHP_SELF'], '/products/') !== false ? 'active' : '' ?>">
            <span class="nav-icon">▦</span>
            Data Products
        </a>
        <a href="<?= e($basePath) ?>pages/suppliers/index.php" class="nav-link <?= strpos($_SERVER['PHP_SELF'], '/suppliers/') !== false ? 'active' : '' ?>">
            <span class="nav-icon">♧</span>
            Data Suppliers
        </a>
        <a href="<?= e($basePath) ?>pages/employees/index.php" class="nav-link <?= strpos($_SERVER['PHP_SELF'], '/employees/') !== false ? 'active' : '' ?>">
            <span class="nav-icon">♙</span>
            Data Employees
        </a>
    </nav>
    <div class="sidebar-note">
        <strong>Sistem Koperasi Sekolah</strong>
        <span>Pengelolaan data master koperasi.</span>
    </div>
</aside>
