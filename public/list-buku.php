<?php
require_once __DIR__ . '/../src/db.php';

$db = new Database();
$pdo = $db->getPdo();

// fitur pencarian
$keyword = isset($_GET['search']) ? $_GET['search'] : '';

if ($keyword) {
    $stmt = $pdo->prepare("SELECT * FROM buku 
                           WHERE judul LIKE :k 
                           OR penulis LIKE :k 
                           OR kategori LIKE :k 
                           ORDER BY id DESC");
    $stmt->execute([":k" => "%$keyword%"]);
} else {
    $stmt = $pdo->query("SELECT * FROM buku ORDER BY id DESC");
}

$data = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Buku</title>
    <style>
        body {
            font-family: Arial;
            background: #f3f2ff;
            padding: 25px;
        }

        h1 {
            text-align: center;
            color: #5d3fd3;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .btn {
            padding: 10px 18px;
            background: #6a5acd;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
        }

        .btn:hover {
            background: #483d8b;
        }

        .btn-add {
            background: #ff66c4;
        }

        .btn-add:hover {
            background: #ff1493;
        }

        /* search box */
        .search-box input {
            padding: 10px;
            width: 250px;
            border: 2px solid #b8a8ff;
            border-radius: 8px;
        }

        /* tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0px 0px 12px #c7bfff;
            table-layout: fixed; /* BIAR RAPI */
        }

        th {
            background: #dcd6ff;
            color: #3c2fa3;
            padding: 12px;
            text-align: left;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            word-wrap: break-word;
        }

        tr:hover {
            background: #f8f0ff;
        }

        /* cover buku */
        .cover-img {
            width: 60px;
            height: 80px;
            object-fit: cover;
            border-radius: 6px;
            border: 2px solid #b19cd9;
        }

        /* tombol aksi */
        .action-buttons {
            display: flex;
            gap: 6px;
        }

        .btn-small {
            padding: 6px 10px;
            font-size: 13px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        .btn-edit {
            background: #6aa9ff;
        }

        .btn-edit:hover {
            background: #1a73e8;
        }

        .btn-delete {
            background: #ff4d6d;
        }

        .btn-delete:hover {
            background: #c9184a;
        }
    </style>
</head>
<body>

<h1>📚 Daftar Buku</h1>

<div class="top-bar">
    <a class="btn" href="index.php">🏠 Beranda</a>

    <form class="search-box" method="GET">
        <input type="text" name="search" placeholder="Cari buku..." value="<?= $keyword ?>">
    </form>

    <a class="btn btn-add" href="create-buku.php">➕ Tambah Buku</a>
</div>

<table>
    <tr>
        <th style="width: 50px;">ID</th>
        <th style="width: 220px;">Judul</th>
        <th style="width: 160px;">Penulis</th>
        <th style="width: 160px;">Penerbit</th>
        <th style="width: 80px;">Tahun</th>
        <th style="width: 120px;">Kategori</th>
        <th style="width: 120px;">Cover</th>
        <th style="width: 150px;">Aksi</th>
    </tr>

    <?php foreach ($data as $buku): ?>
    <tr>
        <td><?= $buku['id'] ?></td>
        <td><?= $buku['judul'] ?></td>
        <td><?= $buku['penulis'] ?></td>
        <td><?= $buku['penerbit'] ?></td>
        <td><?= $buku['tahun_terbit'] ?></td>
        <td><?= $buku['kategori'] ?></td>
        <td>
            <?php if ($buku['cover_path']): ?>
                <img src="<?= $buku['cover_path'] ?>" class="cover-img">
            <?php else: ?>
                <span style="color:#888;">(Tidak ada cover)</span>
            <?php endif; ?>
        </td>

        <td>
            <div class="action-buttons">
                <a class="btn-small btn-edit" href="edit-buku.php?id=<?= $buku['id'] ?>">Edit</a>
                <a class="btn-small btn-delete" 
                   href="delete-buku.php?id=<?= $buku['id'] ?>"
                   onclick="return confirm('Yakin ingin menghapus?')">
                   Hapus
                </a>
            </div>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
