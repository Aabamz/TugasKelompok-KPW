# Frameture

Frameture adalah aplikasi katalog & review film berbasis web, dibangun dengan Laravel dan AdminLTE. Pengguna bisa menjelajahi katalog film, memberi ulasan/rating, menyimpan film ke wishlist, serta terhubung dengan pengguna lain lewat sistem follow — lengkap dengan notifikasi real-time.

Tugas Kelompok — Kelas Pemrograman Web (KPW)

**Anggota Kelompok:**
- Aira Rayyani Saifa Rahman (1)
- Evan Septia Ramadan (9)
- Fauzia Yuan Della (11)
- Siva Mustika (31)
- Zabran Farzana Azaria (35)

---

## Fitur

### Autentikasi & Akun
- Login & Register (dengan opsi kode registrasi khusus untuk mendaftar sebagai admin)
- Lupa password — mengirim link reset password melalui email asli (SMTP)
- Edit profil: foto profil, umur, bio, alamat
- Ubah email akun (wajib konfirmasi password saat ini demi keamanan)
- Social accounts di profil (Instagram, TikTok, GitHub, dll — ikon terdeteksi otomatis)

### Sosial
- Cari & jelajahi pengguna lain
- Follow / Unfollow pengguna
- Lihat daftar Followers & Following
- Notifikasi in-app (lonceng di navbar) saat ada yang follow
- Web Push Notification — notifikasi tetap muncul di HP/browser walau tab ditutup

### Katalog Film
- Daftar film dengan poster, rating rata-rata, dan jumlah ulasan
- Pencarian judul film
- Filter berdasarkan Genre, Tahun, dan Urutan (Terbaru/Populer/Terlama)
- Halaman detail film: sinopsis, genre, daftar pemeran (cast & peran)
- Video player untuk film yang memiliki video (poster tampil dulu, video diputar saat diklik)

### Wishlist
- Tambah/hapus film dari wishlist (ikon hati)
- Halaman "Wishlist Saya"
- Wishlist bisa dilihat publik lewat halaman profil pengguna lain
- Jumlah wishlist per film ditampilkan di katalog & detail film

### Ulasan & Komentar
- Beri ulasan + rating bintang pada film (bukan admin)
- Balas komentar/ulasan pengguna lain (reply bertingkat, seperti Instagram)
- Hapus ulasan/balasan milik sendiri (atau oleh admin)
- Daftar komentar auto-update tanpa reload halaman (polling berkala)

### Admin Panel
- Kelola Data Film (tambah/edit/hapus, upload poster & video)
- Kelola Data Genre, Cast, dan Peran
- Kelola Data User (lihat daftar pengguna terdaftar)
- Admin tidak dapat memberi ulasan pada film

### Branding & UI
- Identitas aplikasi "Frameture" dengan logo & favicon custom
- Tema AdminLTE dengan penyesuaian warna dan tipografi

---

## Teknologi

- **Backend:** Laravel 13, PHP 8.3+
- **Frontend:** Blade Templating, AdminLTE 3, Bootstrap 4, Vite
- **Database:** SQLite — dipilih karena ringan dan tidak perlu instalasi server database terpisah (seperti MySQL/PostgreSQL), sehingga project bisa langsung dijalankan siapa saja setelah clone tanpa setup tambahan. Cocok untuk skala aplikasi tugas kuliah seperti ini.
- **Notifikasi:** Laravel Notifications (database + Web Push/VAPID)
- **Autentikasi:** Session-based (Laravel default)

---

## Instalasi

```bash
git clone <url-repo-ini>
cd TugasKelompok-KPW

composer install
npm install

cp .env.example .env
php artisan key:generate

# Sesuaikan koneksi database di .env, lalu:
php artisan migrate --seed
php artisan storage:link

npm run build
php artisan serve
```

Akun admin default (dari seeder):
- Email: `admin@example.com`
- Password: `password`

---

## Pembagian Tugas Kelompok

Struktur database dikerjakan terbagi 5 bagian sesuai tabel-tabel utama aplikasi. Setelah seluruh bagian database rampung, pengembangan fitur aplikasi (autentikasi, sosial, wishlist, notifikasi, panel admin, dsb.) serta seluruh perbaikan bug dilakukan secara terintegrasi oleh Zabran Farzana Azaria (Anggota 5).

#### Aira Rayyani Saifa Rahman — Setup Database, Konfigurasi, & Tabel Roles
- Mengatur koneksi database di file `.env`.
- Membuat migration dan seeder untuk tabel `roles` (misalnya role admin dan user).
- **Commit Message:** `feat: add roles migration and database seeder`
- **Status:** ✅ Selesai

#### Evan Septia Ramadan — Pembuatan Tabel Profile & Penyesuaian Tabel Users
- Membuat migration dan model untuk tabel `profile`.
- Membuat migration untuk mengubah struktur tabel `users` (menambahkan relasi `role_id` & `profile_id`, serta menyesuaikan kolom bawaan seperti `email_verified_at` & `remember_token`).
- **Commit Message:** `feat: add profile table and update users table migration`
- **Status:** ✅ Selesai

#### Fauzia Yuan Della — Pembuatan Tabel Film & Genre
- Membuat migration dan model untuk tabel `film` (menyimpan data film yang ditampilkan di dashboard).
- Membuat migration dan model untuk tabel `genre` (kategori film).
- **Commit Message:** `feat: add films and genres migration with models`
- **Status:** ✅ Selesai

#### Siva Mustika — Pembuatan Tabel Cast, Peran, & Kritik/Komentar
- Membuat migration dan model untuk tabel `cast` (pemeran film) dan tabel `peran` (relasi film–cast).
- Membuat migration dan model untuk tabel `kritik`/komentar (ulasan user pada film).
- **Commit Message:** `feat: add cast, peran, and review tables migration`
- **Status:** ✅ Selesai

#### Zabran Farzana Azaria — Finalisasi ERD, Integrasi Sistem, Pengembangan Fitur, & Debugging
Tugas awal yang menjadi tanggung jawab bagian ini adalah finalisasi relasi database. Namun karena seluruh bagian database dari anggota 1–4 perlu digabungkan menjadi satu aplikasi yang utuh dan berjalan, bagian ini juga mencakup seluruh proses integrasi, pengembangan fitur, dan perbaikan bug di tahap akhir proyek.

**Tugas awal (database):**
- Memastikan seluruh relasi Foreign Key antar tabel (`users`, `profile`, `film`, `genre`, `cast`, `peran`, `kritik`, dan tabel pendukung lain) terhubung dengan benar pada migration.
- Menyiapkan data dummy di `DatabaseSeeder.php` agar seluruh seeder dapat dijalankan bersamaan (`php artisan db:seed`).
- **Commit Message:** `fix: finalize foreign keys and database seeder integration`

**Tugas lanjutan (integrasi & pengembangan fitur):**
- Menyelesaikan seluruh konflik merge (merge conflict) dari hasil pekerjaan anggota 1–4 agar kode dapat berjalan tanpa error.
- Membangun sistem upload & tampilan foto profil, video film, dan poster.
- Membangun fitur sosial: pencarian pengguna, follow/unfollow, daftar followers & following.
- Membangun sistem notifikasi (in-app dan Web Push) saat ada aktivitas follow.
- Membangun fitur wishlist film, termasuk tampilan publik di halaman profil.
- Membangun fitur balas komentar (reply) bertingkat beserta hak hapus komentar.
- Membangun fitur pencarian & filter katalog film (genre, tahun, urutan).
- Membangun sistem lupa password dengan pengiriman email reset yang fungsional.
- Menerapkan branding aplikasi (nama, logo, favicon, tipografi).
- Melakukan debugging menyeluruh (routing, cache, permission storage, konflik file) hingga aplikasi siap dipakai dan di-deploy untuk demo.
- **Commit Message:** `feat: integrate modules, build core features, and resolve application-wide bugs`
- **Status:** ✅ Selesai
