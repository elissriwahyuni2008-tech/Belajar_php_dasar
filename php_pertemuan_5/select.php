<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "php_dasar";

// Koneksi ke database
$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

echo "Koneksi berhasil<br>";

// Mengambil data dari tabel orang
$query = "SELECT * FROM orang";
$result = mysqli_query($conn, $query);

$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Menampilkan data
foreach ($data as $row) {
    echo "Nama : " . $row["nama"] . "<br>";
    echo "Umur : " . $row["umur"] . "<br>";
    echo "Alamat : " . $row["alamat"] . "<br>";
    echo "<hr>";
}

?>