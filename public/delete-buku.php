<?php
require_once __DIR__ . '/../src/db.php';

$db = new Database();
$pdo = $db->getPdo();

if (!isset($_GET['id'])) {
    die("ID buku tidak ditemukan!");
}

$id = $_GET["id"];

// Ambil data buku (untuk hapus cover)
$stmt = $pdo->prepare("SELECT * FROM buku WHERE id = :id");
$stmt->execute([":id" => $id]);
$buku = $stmt->fetch();

if (!$buku) {
    die("Data buku tidak ditemukan!");
}

// Hapus cover jika ada
if ($buku['cover_path']) {
    $file_path = __DIR__ . "/" . $buku['cover_path'];
    if (file_exists($file_path)) {
        unlink($file_path); // hapus file cover
    }
}

// Hapus data buku dari database
$stmt = $pdo->prepare("DELETE FROM buku WHERE id = :id");
$stmt->execute([":id" => $id]);

header("Location: list-buku.php");
exit;
