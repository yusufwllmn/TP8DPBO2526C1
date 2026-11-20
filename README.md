# MVC

## Janji

Saya Yusuf Willman Hammam dengan NIM 2511185 mengerjakan Tugas Praktikum 8 dalam mata kuliah Desain Pemrograman Berorientasi Objek (DPBO) untuk keberkahan-Nya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

## Tema

Website ini berbasis PHP Native untuk mengelola data dosen beserta mata kuliah yang diampu dan publikasi yang pernah mereka tulis. Aplikasi ini dibuat dengan arsitektur MVC (Model, View, Controller).

## Desain

### Database: `db_lecturer`

| Tabel | Kolom | Keterangan |
|---|---|---|
| `lecturers` | `id` (PK), `name`, `nidn`, `phone`, `join_date`, `email`, `department` | Data dosen. `email` dan `department` adalah kolom tambahan dari tabel awal, dan `nidn` dibuat unik |
| `courses` | `id` (PK), `lecturer_id` (FK), `course_code`, `course_name`, `credits` | Mata kuliah yang diampu dosen |
| `publications` | `id` (PK), `lecturer_id` (FK), `title`, `journal_name`, `publish_year` | Publikasi jurnal milik dosen |

Relasi: `lecturers` 1 : N `courses` dan `lecturers` 1 : N `publications`. Kalau seorang dosen dihapus, mata kuliah dan publikasinya ikut terhapus (`ON DELETE CASCADE`).

File SQL: `database/db_lecturer.sql`

### Class

| Class | Fungsi |
|---|---|
| `Model` | Abstract class induk untuk semua model. Berisi koneksi PDO dan method umum `all`, `find`, `create`, `update`, `delete` |
| `Lecturer` | Model tabel dosen, termasuk menghitung jumlah mata kuliah dan publikasi tiap dosen |
| `Course` | Model tabel mata kuliah, termasuk JOIN untuk menampilkan nama dosen pengampu |
| `Publication` | Model tabel publikasi, termasuk JOIN untuk menampilkan nama penulis |
| `Controller` | Abstract class induk untuk semua controller. Mengatur alur tampil, simpan, ubah, dan hapus, serta validasi input |
| `LecturerController` | Controller untuk halaman dosen |
| `CourseController` | Controller untuk halaman mata kuliah, ikut mengirim daftar dosen untuk dropdown |
| `PublicationController` | Controller untuk halaman publikasi, ikut mengirim daftar dosen untuk dropdown |

Seluruh query memakai PDO dengan Prepared Statement (`prepare()` + `execute()`).

### Struktur Folder

| Folder / File | Fungsi |
|---|---|
| `assets/` | File Bootstrap dan `style.css` |
| `config/` | Koneksi database (PDO) |
| `controllers/` | Controller yang menghubungkan model dan view |
| `database/` | File `.sql` |
| `models/` | Model yang berhubungan langsung dengan database |
| `views/` | Tampilan halaman dosen, mata kuliah, dan publikasi, serta header dan footer bersama |
| `index.php` | Pintu masuk aplikasi sekaligus router |

## Alur Program

1. User membuka `index.php?page=...`. File ini memuat konfigurasi, membuat koneksi PDO, lalu memilih controller sesuai halaman yang diminta (dosen, mata kuliah, atau publikasi).
2. Controller meminta data ke model, lalu mengirimkannya ke view. Halaman dibagi dua: daftar data di sisi kiri dan form tambah/ubah di sisi kanan.
3. Saat user menekan **Ubah** pada satu baris, data baris itu dimuat ke form di sisi kanan. Saat menekan **Tambah**, **Simpan perubahan**, atau **Hapus**, form mengirim request POST ke controller.
4. Controller memvalidasi input (semua kolom wajib diisi), lalu memanggil method model terkait (`create`, `update`, atau `delete`).
5. Model menjalankan prepared statement ke database melalui PDO.
6. Controller me-redirect ke halaman daftar dan menampilkan pesan berhasil atau gagal, misalnya kalau NIDN sudah dipakai dosen lain.

## Dokumentasi

1. CRUD pada halaman Dosen
   <img width="1280" height="720" alt="CRUD Dosen" src="https://github.com/user-attachments/assets/c580954d-23dc-49af-ada2-7a42324b5242" />

2. CRUD pada halaman Mata Kuliah
   <img width="1280" height="720" alt="CRUD Mata Kuliah" src="https://github.com/user-attachments/assets/948a6b9a-7621-470a-8394-b13a0a76612d" />

3. CRUD pada halaman Publikasi
   <img width="1280" height="720" alt="CRUD Publikasi" src="https://github.com/user-attachments/assets/85b341cf-8f90-4918-9558-a41116ab857c" />
