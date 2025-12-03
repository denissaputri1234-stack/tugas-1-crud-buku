# crud-buku
Tugas 1 CRUD PHP
# CRUD Buku

Aplikasi ini adalah sebuah project sederhana berbasis PHP dan MySQL yang di bangun untuk memahami dasar-dasar operasi CRUD (Create, Read, Update, Delete). Aplikasi ini digunakan untuk mengelola data buku, yaitu menyimpan, menampilkan, mengedit, dan menghapus data buku yang ada di database.

---

#  Tentang Project

Aplikasi **CRUD Buku** ini dibuat menggunakan **PHP Native**, **MySQL**, dan sedikit HTML/CSS untuk tampilan. Aplikasi ini digunakan untuk mengelola data buku seperti:

* Menambah buku
* Menampilkan daftar buku
* Mengedit data buku
* Menghapus buku
* Upload cover buku
* Pencarian buku berdasarkan judul/penulis/kategori

Project ini cocok bagi mahasiswa atau pemula yang sedang belajar web development dasar.


#  Fitur Aplikasi

* Menampilkan daftar semua buku
* Pencarian data buku (judul, penulis, kategori)
* Tambah data buku baru
* Edit data buku + update cover
* Hapus buku + hapus file cover
* Validasi input
* Upload cover buku otomatis tersimpan di folder `uploads/`
* UI sederhana dan mudah digunakan

---

#  Struktur Folder Project

crud-buku/
│──public
   └──  index.php            # Halaman utama / dashboard
   └──  list-buku.php        # Daftar semua buku
   └──  create-buku.php      # Form tambah buku
   └──  edit-buku.php        # Form edit buku
   └──  delete-buku.php      # Hapus data buku
│
├── uploads/             # Tempat penyimpanan file cover buku
│
└── src/
    └── db.php           # File koneksi database
    

#  Instalasi Database

### 1️ Buat database baru (misal: `crud_buku`)

### 2️ Jalankan SQL berikut:

```sql
CREATE TABLE buku (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    penulis VARCHAR(255) NOT NULL,
    penerbit VARCHAR(255) NOT NULL,
    tahun_terbit INT NOT NULL,
    kategori VARCHAR(100),
    cover_path VARCHAR(255)
);
```

---

# 🔌 Koneksi Database (db.php)

Isi file `src/db.php`:

```php
class Database {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO("mysql:host=localhost;dbname=crud_buku", "root", "");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getPdo() {
        return $this->pdo;
    }
}
```

> Sesuaikan `username`, `password`, dan `dbname` jika perlu.

---

#  Cara Menjalankan Project

1️ Pindahkan folder project ke:

```
C:/xampp/htdocs/crud-buku
```

2️ Jalankan **Apache** dan **MySQL** melalui XAMPP
3️ Import tabel `buku` ke database
4️ Buka browser dan akses:

```
http://localhost/crud-buku
```

---

#  Penjelasan Setiap File

## **1. index.php**

berikut adalah tampilan halaman index.php:
<img width="1772" height="856" alt="tampilan index php" src="https://github.com/user-attachments/assets/34d68970-3c27-4b56-b5f3-f80cffe05710" />

* index.php disini berperan menjadi Halaman utama
* Terdapat Navigasi ke daftar buku dan tambah data

## **2. list-buku.php**
berikut adalah tampilan halaman list-buku.php:
<img width="1915" height="843" alt="tampilan list-buku php" src="https://github.com/user-attachments/assets/3cd11848-6637-4701-ab10-14e182be798c" />

* Menampilkan tabel daftar semua buku
* Ada fitur pencarian (penerbit,penulis,tahun terbit,judul,kategori)
* Ada tombol aksi *Edit* dan *Hapus* daftar buku
* Menampilkan cover buku ukuran kecil
* menampilkan id,judul,penulis,penerbit,tahun terbit,kategori
* terdapat tombol navigasi kembali ke beranda dan navigasi tambah buku

## **3. create-buku.php**
berikut adalah tampilan halaman create-buku.php:
<img width="1811" height="876" alt="tampilan create-buku php" src="https://github.com/user-attachments/assets/e5119798-0558-434c-9446-de017fd2a663" />

* Form untuk menambah buku baru
* Validasi input (penulis,penerbit,dan tahun terbit wajib di isi)
* Upload cover buku (opsional)

## **4. edit-buku.php**
berikut adalah tampilan halaman edit-buku.php:
<img width="1660" height="840" alt="tampilan edit-buku php" src="https://github.com/user-attachments/assets/f9993e86-eca1-4778-ae27-0fe44a63efeb" />

* Mengambil data berdasarkan ID
* Menampilkan cover lama
* Bisa upload cover baru
* Cover lama otomatis terhapus jika diganti

## **5. delete-buku.php**
berikut adalah tampilan halaman delete-buku.php:
<img width="1646" height="855" alt="tampilan delete-buku php" src="https://github.com/user-attachments/assets/5853f5a7-93fb-4ca3-9acf-185a5d5b8ae2" />

* Menghapus data berdasarkan ID
* Menghapus file cover dari folder `uploads/`
* jika ingin menghapus buku terdapat konfirmasi hapus pop up yg muncul untuk meyakinkan pengguna sebelum melakukan tindakan yang tidak bisa dibatalkan.

---

#  Mekanisme Upload Cover

* File disimpan di `/uploads/`
* Nama file otomatis menggunakan timestamp (`time()`) supaya tidak bentrok
* Cover lama dihapus otomatis saat edit
* Mendukung format `.jpg`, `.png`, `.jpeg`

---

#  Fitur Pencarian

Menggunakan query `LIKE` pada:

* judul
* penulis
* kategori

Contoh query:

```sql
SELECT * FROM buku WHERE judul LIKE '%kata%' OR penulis LIKE '%kata%' OR kategori LIKE '%kata%'
```

---

#  Kelebihan Project Ini

* CRUD lengkap dan rapi
* Upload file aman
* Tampilan sederhana & modern
* Cocok untuk tugas kuliah
* Mudah dikembangkan ke versi yang lebih besar

---

#  Teknologi yang Digunakan

* PHP Native
* MySQL + PDO
* HTML + CSS
* XAMPP (Apache)

---

#  Lisensi

Proyek ini bebas digunakan untuk **pembelajaran dan tugas kuliah**.

---

