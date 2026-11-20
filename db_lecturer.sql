CREATE DATABASE IF NOT EXISTS db_lecturer CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_lecturer;

DROP TABLE IF EXISTS publications;
DROP TABLE IF EXISTS courses;
DROP TABLE IF EXISTS lecturers;

CREATE TABLE lecturers (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  name       VARCHAR(100) NOT NULL,
  nidn       VARCHAR(20)  NOT NULL UNIQUE,
  phone      VARCHAR(20)  NOT NULL,
  join_date  DATE         NOT NULL,
  email      VARCHAR(100) NOT NULL,
  department VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE courses (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  lecturer_id INT          NOT NULL,
  course_code VARCHAR(20)  NOT NULL,
  course_name VARCHAR(100) NOT NULL,
  credits     TINYINT      NOT NULL,
  CONSTRAINT fk_courses_lecturer FOREIGN KEY (lecturer_id)
    REFERENCES lecturers (id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE publications (
  id           INT AUTO_INCREMENT PRIMARY KEY,
  lecturer_id  INT          NOT NULL,
  title        VARCHAR(200) NOT NULL,
  journal_name VARCHAR(150) NOT NULL,
  publish_year YEAR         NOT NULL,
  CONSTRAINT fk_publications_lecturer FOREIGN KEY (lecturer_id)
    REFERENCES lecturers (id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

INSERT INTO lecturers (name, nidn, phone, join_date, email, department) VALUES
('Dr. Hendra Nugraha, M.T.',  '0412038101', '081322004411', '2009-02-02', 'hendra.nugraha@upi.edu',   'Ilmu Komputer'),
('Rini Maharani, M.Kom.',     '0426048803', '085720113390', '2014-09-01', 'rini.maharani@upi.edu',    'Pendidikan Ilmu Komputer'),
('Fajar Setiawan, M.Sc.',     '0407118205', '081910667245', '2012-03-01', 'fajar.setiawan@upi.edu',   'Ilmu Komputer'),
('Dewi Kartikasari, M.T.',    '0419078707', '087822540018', '2017-08-15', 'dewi.kartikasari@upi.edu', 'Ilmu Komputer'),
('Arif Budiman, M.Kom.',      '0403049002', '082116778903', '2019-02-01', 'arif.budiman@upi.edu',     'Pendidikan Ilmu Komputer'),
('Yuniar Lestari, Ph.D.',     '0430067904', '081234905521', '2006-09-01', 'yuniar.lestari@upi.edu',   'Ilmu Komputer');

INSERT INTO courses (lecturer_id, course_code, course_name, credits) VALUES
(1, 'IK301', 'Kecerdasan Buatan', 3),
(1, 'IK405', 'Pemrosesan Bahasa Alami', 3),
(2, 'IK101', 'Algoritma dan Pemrograman', 3),
(2, 'IK203', 'Struktur Data', 3),
(3, 'IK302', 'Basis Data', 3),
(3, 'IK310', 'Pemrograman Web', 3),
(4, 'IK304', 'Jaringan Komputer', 3),
(4, 'IK207', 'Sistem Operasi', 3),
(5, 'IK212', 'Grafika Komputer', 3),
(6, 'IK406', 'Kriptografi', 3),
(6, 'IK408', 'Data Mining', 3);

INSERT INTO publications (lecturer_id, title, journal_name, publish_year) VALUES
(1, 'Klasifikasi Sentimen Ulasan Aplikasi Menggunakan Naive Bayes', 'Jurnal Ilmu Komputer Nusantara', 2021),
(1, 'Perbandingan Model Transformer untuk Peringkasan Teks Berbahasa Indonesia', 'Jurnal Linguistik Komputasional', 2023),
(2, 'Pengembangan Media Pembelajaran Algoritma Berbasis Web', 'Jurnal Pendidikan Informatika', 2020),
(3, 'Optimasi Query pada Basis Data Akademik Skala Menengah', 'Jurnal Sistem Informasi Terapan', 2022),
(4, 'Analisis Kinerja Jaringan Nirkabel di Lingkungan Kampus', 'Jurnal Teknologi Jaringan', 2021),
(6, 'Penerapan AES pada Pengamanan Berkas Rekam Akademik', 'Jurnal Keamanan Informasi', 2024),
(6, 'Prediksi Kelulusan Mahasiswa dengan Random Forest', 'Jurnal Ilmu Komputer Nusantara', 2022);
