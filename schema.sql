CREATE DATABASE buku_db;
Use buku_db;

CREATE TABLE buku (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(200),
    penulis VARCHAR(150),
    penerbit VARCHAR(150),
    tahun_terbit INT,
    kategori VARCHAR(100),
    cover_path VARCHAR(255)
);
