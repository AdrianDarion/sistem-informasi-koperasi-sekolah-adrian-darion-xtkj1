<?php
require_once __DIR__ . '/../../helpers.php';
require_once __DIR__ . '/../../repositories/employee-repository.php';
$employees = getEmployees();
$errors = takeFlash('errors');
$success = takeFlash('success', '');
$pageTitle = 'Data Employees';
$pageSubtitle = 'Kelola data pegawai koperasi sekolah.';
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Employees - Koperasi Sekolah</title>
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
                            <h2>Daftar Pegawai</h2>
                            <p>Data pegawai yang bekerja di koperasi.</p>
                        </div>
                        <a class="btn btn-primary" href="create.php">+ Tambah Pegawai</a>
                    </div>
                    <div class="table-card">
                        <div class="table-wrap">
                            <table>
                                <thead>
                                    <tr>
                                        <th>No. Pegawai</th>
                                        <th>Nama Lengkap</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Jabatan</th>
                                        <th>Gaji</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!$employees): ?>
                                        <tr>
                                            <td colspan="7" class="empty">Belum ada data pegawai.</td>
                                        </tr>
                                        <?php else: ?>
                                        <?php foreach ($employees as $employee): ?>
                                            <tr>
                                                <td>
                                                    <span class="code-pill"><?= e($employee['employee_number']) ?></span>
                                                </td>
                                                <td>
                                                    <strong><?= e($employee['full_name']) ?></strong>
                                                </td>
                                                <td><?= $employee['gender'] === 'M' ? 'Laki-laki' : 'Perempuan' ?></td>
                                                <td><?= e($employee['birth_date']) ?></td>
                                                <td><?= e($employee['position']) ?></td>
                                                <td>Rp <?= number_format((float) $employee['salary'], 0, ',', '.') ?></td>
                                                <td>
                                                    <div class="actions">
                                                        <a class="btn btn-small btn-light" href="edit.php?id=<?= (int) $employee['employee_id'] ?>">Edit</a>
                                                        <form method="POST" action="../../actions/employees/destroy.php" onsubmit="return confirm('Yakin ingin menghapus data pegawai ini?')">
                                                            <input type="hidden" name="id" value="<?= (int) $employee['employee_id'] ?>">
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
