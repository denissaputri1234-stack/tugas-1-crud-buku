<?php
require_once __DIR__ . '/../src/db.php';

$db = new Database();
$pdo = $db->getPdo();

echo "Koneksi ke database BERHASIL!";

