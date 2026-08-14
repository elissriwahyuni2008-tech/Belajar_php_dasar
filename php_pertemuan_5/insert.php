<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "php_dasar";

// Membuat koneksi database
$conn = mysqli_connect($host, $user, $pass, $db);

// Mengecek koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

echo "Koneksi berhasil<br>";

// Query untuk menambahkan data
$query = "INSERT INTO orang (nama, tgl_lahir, kelas, umur, alamat, ...)
          VALUES (NULL, 'Andi', 20, 'Bandung')";

// Menjalankan query
if (mysqli_query($conn, $query)) {
    echo "Data berhasil ditambahkan<br>";
} else {
    echo "Data gagal ditambahkan: " . mysqli_error($conn);
}

// Menutup koneksi
mysqli_close($conn);

?>