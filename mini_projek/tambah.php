<?php

require_once "config.php";

if (!isset($_SESSION['user_id'])) {

    header("Location: login.php");
    exit;

}

if (isset($_POST['simpan'])) {

    $nama = $_POST['nama_barang'];
    $kategori = $_POST['kategori'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];

    $query = mysqli_query(
        $conn,
        "INSERT INTO barang
        (nama_barang, kategori, stok, harga)
        VALUES
        ('$nama', '$kategori', '$stok', '$harga')"
    );

    if ($query) {

        header("Location: dashboard.php");
        exit;

    }

}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Tambah Barang</title>

    <link
        rel="stylesheet"
        href="style.css"
    >

</head>

<body>

<header>

    <div class="logo">
        Mini Project
    </div>

    <a
        href="dashboard.php"
        class="kembali"
    >
        Kembali
    </a>

</header>

<div class="form-container">

    <div class="card">

        <h1>
            Tambah Data Barang
        </h1>

        <form method="POST">

            <label>
                Nama Barang
            </label>

            <input
                type="text"
                name="nama_barang"
                placeholder="Contoh: Buku"
                required
            >

            <label>
                Stok
            </label>

            <input
                type="number"
                name="stok"
                placeholder="Masukkan stok"
                required
            >

            <label>
                Harga
            </label>

            <input
                type="number"
                name="harga"
                placeholder="Masukkan harga"
                required
            >

            <button
                type="submit"
                name="simpan"
            >
                Simpan Data
            </button>

        </form>

    </div>

</div>

</body>

</html>