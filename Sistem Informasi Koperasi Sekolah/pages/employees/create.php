<?php
require_once __DIR__ . '/../../helpers.php';
$errors = takeFlash('errors');
$old = takeFlash('old');
$pageTitle = 'Tambah Pegawai';
$pageSubtitle = 'Masukkan informasi pegawai koperasi.';
$positions = ['Cashier', 'Warehouse Staff', 'Admin'];
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tambah Pegawai</title>
        <link rel="stylesheet" href="../../styles/app.css">
    </head>
    <body>
        <div class="app-layout">
            <?php require __DIR__ . '/../../components/sidebar.php'; ?>
            <main class="main-area">
                <?php require __DIR__ . '/../../components/topbar.php'; ?>
                <section class="content-area">
                    <form class="form-card" method="POST" action="../../actions/employees/store.php">
                        <?php if (!empty($errors['general'])): ?>
                            <div class="alert alert-error full-field"><?= e($errors['general']) ?></div>
                        <?php endif; ?>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="employee_number">Nomor Pegawai *</label>
                                <input id="employee_number" name="employee_number" type="text" maxlength="10" required value="<?= e($old['employee_number'] ?? '') ?>">
                                <?php if (!empty($errors['employee_number'])): ?>
                                    <small class="error-text"><?= e($errors['employee_number']) ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="full_name">Nama Lengkap *</label>
                                <input id="full_name" name="full_name" type="text" maxlength="100" required value="<?= e($old['full_name'] ?? '') ?>">
                                <?php if (!empty($errors['full_name'])): ?>
                                    <small class="error-text"><?= e($errors['full_name']) ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin *</label>
                                <div class="choice-row">
                                    <label class="choice">
                                        <input type="radio" name="gender" value="M" required <?= ($old['gender'] ?? '') === 'M' ? 'checked' : '' ?>>
                                        Laki-laki
                                    </label>
                                    <label class="choice">
                                        <input type="radio" name="gender" value="F" required <?= ($old['gender'] ?? '') === 'F' ? 'checked' : '' ?>>
                                        Perempuan
                                    </label>
                                </div>
                                <?php if (!empty($errors['gender'])): ?>
                                    <small class="error-text"><?= e($errors['gender']) ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="birth_date">Tanggal Lahir *</label>
                                <input id="birth_date" name="birth_date" type="date" required value="<?= e($old['birth_date'] ?? '') ?>">
                                <?php if (!empty($errors['birth_date'])): ?>
                                    <small class="error-text"><?= e($errors['birth_date']) ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="position">Jabatan *</label>
                                <select id="position" name="position" required>
                                    <option value="">Pilih jabatan</option>
                                    <?php foreach ($positions as $position): ?>
                                        <option value="<?= e($position) ?>" <?= ($old['position'] ?? '') === $position ? 'selected' : '' ?>><?= e($position) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (!empty($errors['position'])): ?>
                                    <small class="error-text"><?= e($errors['position']) ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="salary">Gaji (Rp) *</label>
                                <input id="salary" name="salary" type="number" min="0" step="0.01" required value="<?= e($old['salary'] ?? '') ?>">
                                <?php if (!empty($errors['salary'])): ?>
                                    <small class="error-text"><?= e($errors['salary']) ?></small>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-actions">
                            <a class="btn btn-light" href="index.php">Kembali</a>
                            <button class="btn btn-primary" type="submit">Simpan Pegawai</button>
                        </div>
                    </form>
                </section>
            </main>
        </div>
    </body>
</html>
