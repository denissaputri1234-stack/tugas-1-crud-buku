<?php
require_once __DIR__ . '/../src/db.php';

$db = new Database();
$pdo = $db->getPdo();

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $judul = $_POST["judul"];
    $penulis = $_POST["penulis"];
    $penerbit = $_POST["penerbit"];
    $tahun = $_POST["tahun_terbit"];
    $kategori = $_POST["kategori"];

    if (empty($judul)) $errors[] = "Judul wajib diisi";
    if (empty($penulis)) $errors[] = "Penulis wajib diisi";
    if (empty($penerbit)) $errors[] = "Penerbit wajib diisi";
    if (empty($tahun)) $errors[] = "Tahun terbit wajib diisi";

    // Upload cover
    $cover_path = null;
    if (!empty($_FILES["cover"]["name"])) {

        $nama_file = time() . "-" . basename($_FILES["cover"]["name"]);
        $target = __DIR__ . "/uploads/" . $nama_file;

        if (move_uploaded_file($_FILES["cover"]["tmp_name"], $target)) {
            $cover_path = "uploads/" . $nama_file;
        } else {
            $errors[] = "Gagal upload cover buku!";
        }
    }

    // Insert data
    if (empty($errors)) {
        $sql = "INSERT INTO buku (judul, penulis, penerbit, tahun_terbit, kategori, cover_path)
                VALUES (:judul, :penulis, :penerbit, :tahun_terbit, :kategori, :cover_path)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ":judul" => $judul,
            ":penulis" => $penulis,
            ":penerbit" => $penerbit,
            ":tahun_terbit" => $tahun,
            ":kategori" => $kategori,
            ":cover_path" => $cover_path
        ]);

        header("Location: list-buku.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Buku</title>
    <style>
        body {
            font-family: Arial;
            background: linear-gradient(to bottom right, #ffd6f8, #cce5ff);
            margin: 0;
            padding: 30px;
        }

        .container {
            width: 450px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0px 0px 10px #d9b3ff;
        }

        h2 {
            text-align: center;
            color: #d63384;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        input, select {
            width: 100%;
            padding: 10px;
            border: 2px solid #ffc0e1;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #ff66c4;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 12px;
            background: #ff66c4;
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 18px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn:hover {
            background: #ff1493;
        }

        .back {
            display: block;
            text-align: center;
            margin-bottom: 15px;
            text-decoration: none;
            color: #1a73e8;
        }

        .error {
            background: #ffe6ee;
            color: #d90429;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Tambah Buku</h2>

    <a href="list-buku.php" class="back">⬅ Kembali ke Daftar Buku</a>

    <?php if (!empty($errors)): ?>
        <div class="error">
            <?php foreach ($errors as $e): ?>
                <p><?= $e ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">

        <label>Judul Buku</label>
        <input type="text" name="judul">

        <label>Penulis</label>
        <input type="text" name="penulis">

        <label>Penerbit</label>
        <input type="text" name="penerbit">

        <label>Tahun Terbit</label>
        <input type="number" name="tahun_terbit">

        <label>Kategori</label>
        <select name="kategori">
            <option value="Novel">Novel</option>
            <option value="Komik">Komik</option>
            <option value="Pendidikan">Pendidikan</option>
            <option value="Bisnis">Bisnis</option>
            <option value="Lainnya">Lainnya</option>
        </select>

        <label>Cover Buku</label>
        <input type="file" name="cover">

        <button type="submit" class="btn">Simpan Buku</button>

    </form>
</div>

</body>
</html>
