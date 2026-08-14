<?php

require_once "config.php";

if (!isset($_SESSION['user_id'])) {

    header("Location: login.php");
    exit;

}

$id = $_GET['id'];

$query = mysqli_query(
    $conn,
    "SELECT * FROM barang
     WHERE id='$id'"
);

$data = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {

    $nama = $_POST['nama_barang'];
    $kategori = $_POST['kategori'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];

    mysqli_query(
        $conn,
        "UPDATE barang SET

        nama_barang='$nama',
        kategori='$kategori',
        stok='$stok',
        harga='$harga'

        WHERE id='$id'"
    );

    header("Location: dashboard.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Edit Barang</title>

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
            Edit Data Barang
        </h1>

        <form method="POST">

            <label>
                Nama Barang
            </label>

            <input
                type="text"
                name="nama_barang"
                value="<?= $data['nama_barang'] ?>"
                required
            >

            <label>
                Kategori
            </label>

            <label>
                Stok
            </label>

            <input
                type="number"
                name="stok"
                value="<?= $data['stok'] ?>"
                required
            >

            <label>
                Harga
            </label>

            <input
                type="number"
                name="harga"
                value="<?= $data['harga'] ?>"
                required
            >

            <button
                type="submit"
                name="update"
            >
                Update Data
            </button>

        </form>

    </div>

</div>

</body>

</html>