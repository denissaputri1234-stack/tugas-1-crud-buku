<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Beranda Kelola Buku</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f4f7fb; /* abu putih modern */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: white;
            width: 520px;
            padding: 40px;
            border-radius: 14px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
            text-align: center;
        }

        h1 {
            margin: 0;
            font-size: 30px;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        p {
            margin: 0;
            margin-bottom: 25px;
            font-size: 15px;
            color: #555;
        }

        .btn {
            display: inline-block;
            padding: 12px 26px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.25s;
            margin: 6px;
        }

        .btn-primary {
            background: #2980b9;
            color: white;
        }

        .btn-primary:hover {
            background: #1c5f8c;
        }

        .btn-secondary {
            background: #ecf0f1;
            color: #34495e;
        }

        .btn-secondary:hover {
            background: #d0d7dd;
        }

        .icon {
            font-size: 55px;
            margin-bottom: 10px;
            color: #2980b9;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="icon">📘</div>
    <h1>Kelola Buku</h1>
    <p>Kelola koleksi bacaan dengan mudah dan rapi.</p>

    <a href="list-buku.php" class="btn btn-primary">📚 Daftar Buku</a>
    <a href="create-buku.php" class="btn btn-secondary">➕ Tambah Buku</a>
</div>

</body>
</html>
