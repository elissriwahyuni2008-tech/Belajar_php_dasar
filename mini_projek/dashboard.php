<?php

require_once "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$search = "";

if (isset($_GET['search'])) {
    $search = $_GET['search'];

    $query = mysqli_query(
        $conn,
        "SELECT * FROM barang
         WHERE nama_barang LIKE '%$search%'
         ORDER BY id DESC"
    );
} else {
    $query = mysqli_query(
        $conn,
        "SELECT * FROM barang
         ORDER BY id DESC"
    );
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header>
    <div class="logo">
        Mini Project
    </div>

    <div>
        Halo,
        <b>
            <?= $_SESSION['nama'] ?>
        </b>

        <a href="logout.php" class="logout">
            Logout
        </a>
    </div>
</header>

<div class="container">

    <div class="judul">
        <div>
            <h1>Data Barang</h1>
            <p>
                Kelola data barang dengan mudah.
            </p>
        </div>

        <a href="tambah.php" class="tombol">
            + Tambah Data
        </a>
    </div>

    <div class="search-box">
        <form method="GET">
            <input
                type="text"
                name="search"
                placeholder="Cari nama barang..."
                value="<?= $search ?>"
            >

            <button type="submit">
                Search
            </button>
        </form>
    </div>

    <div class="card-table">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
            <?php
            $no = 1;
            while ($data = mysqli_fetch_assoc($query)):
            ?>
                <tr>
                    <td>
                        <?= $no++ ?>
                    </td>

                    <td>
                        <?= $data['nama_barang'] ?>
                    </td>

                    <td>
                        <?= $data['stok'] ?>
                    </td>

                    <td>
                        Rp <?= number_format(
                            $data['harga'],
                            0,
                            ',',
                            '.'
                        ) ?>
                    </td>

                    <td>
                        <a href="edit.php?id=<?= $data['id'] ?>" class="edit">
                            Edit
                        </a>

                        <a
                            href="hapus.php?id=<?= $data['id'] ?>"
                            class="hapus"
                            onclick="return confirm('Yakin ingin menghapus data?')"
                        >
                            Hapus
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</div>

</body>

</html>