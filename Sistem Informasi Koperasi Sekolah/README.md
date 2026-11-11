# Sistem Informasi Koperasi Sekolah

Project CRUD PHP Native + MySQL dengan pola folder yang dipisah seperti referensi BukuKita.

## Fitur

- CRUD untuk `products`, `suppliers`, dan `employees`.
- PDO dan prepared statement pada query data.
- Validasi kolom wajib, format email, angka non-negatif, pilihan ENUM, serta kode/nomor unik.
- Input kategori memakai select, unit dan gender memakai radio button, serta jenis produk supplier memakai checkbox.
- Nilai checkbox `product_types` disimpan dalam satu kolom VARCHAR dengan format JSON.
- Form edit menampilkan data lama, termasuk select, radio, dan checkbox.
- Hapus data menggunakan metode POST dan meminta konfirmasi.
- Dashboard dapat dibuka langsung tanpa login.
- Form login berada di bagian kanan atas dashboard, bukan di halaman awal yang terpisah.
- Login di kanan atas bersifat opsional dan hanya mengubah tampilan status akun.
- Semua orang dapat melihat, menambah, mengubah, dan menghapus data tanpa login.
- Pengguna yang login maupun yang tidak login memiliki akses pengelolaan yang sama.
- Tombol Keluar hanya mengakhiri session tampilan akun; semua menu CRUD tetap bisa digunakan.
- Database transaction tidak digunakan karena untuk kelas 10 tidak diwajibkan dalam lembar tugas.

## Akun bawaan

- Username: `admin`
- Password: `koperasi123`

Pengaturan akun berada di `config/auth.php`. Password disimpan dalam bentuk hash dan diperiksa menggunakan `password_verify()`.

## Menjalankan di Laragon

1. Ekstrak folder `koperasi-sekolah` ke `C:\laragon\www\`.
2. Buka Laragon lalu klik **Start All** agar Apache dan MySQL berjalan.
3. Pastikan database `db_cooperative` serta tabel `products`, `suppliers`, dan `employees` sudah tersedia.
4. Periksa `config/database.php`. Pengaturan bawaan adalah host `localhost`, username `root`, password kosong, dan database `db_cooperative`. Sesuaikan jika pengaturan Laragon berbeda.
5. Buka `http://localhost/koperasi-sekolah/` atau jalankan server PHP pada port 3000.
6. Dashboard langsung tampil. Kamu bisa langsung mengelola data tanpa login. Form di kanan atas hanya opsional; login atau tidak, semua pengguna memiliki akses yang sama.

## Jika database dan tabel sudah dibuat

Tidak perlu menjalankan file SQL lagi. Cocokkan nama tabel, kolom, tipe data, dan nilai ENUM dengan soal guru. File cadangan struktur ada di `database/db_cooperative.sql`.

## Struktur tabel yang diharapkan

- `products`: `product_id`, `product_code`, `product_name`, `category`, `unit`, `price`, `stock`, `entry_date`, `description`.
- `suppliers`: `supplier_id`, `supplier_name`, `email`, `phone`, `address`, `product_types`, `partnership_date`.
- `employees`: `employee_id`, `employee_number`, `full_name`, `gender`, `birth_date`, `position`, `salary`.

Ketiga tabel berdiri sendiri dan tidak menggunakan foreign key, sesuai lembar tugas.

## Catatan

- `description` pada products dibuat opsional sebagai keterangan tambahan. Kolom lain ditandai wajib pada form.
- Login admin adalah fitur tambahan yang bersifat opsional dan tidak menambah tabel pada database tugas. Login tidak membatasi atau menambah hak akses.
- Sebelum dikumpulkan, uji tambah, tampil, edit, dan hapus pada masing-masing tabel, lalu export database dari phpMyAdmin sebagai file `.sql`.
