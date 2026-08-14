<?php
// Konfigurasi Database
$host     = "localhost";
$dbUser   = "root";
$dbPass   = "";
$dbName   = "php_dasar";

// Membuat koneksi ke database
$koneksi = mysqli_connect($host, $dbUser, $dbPass, $dbName);

// Cek status koneksi
if (mysqli_connect_errno()) {
    exit("Koneksi gagal: " . mysqli_connect_error());
}
echo "Koneksi berhasil!<br>";

// Query SQL untuk memperbarui data
$query = "UPDATE orang 
          SET nama = 'Budi Santoso', 
              umur = 30, 
              alamat = 'Jakarta' 
          WHERE id = 1";

// Eksekusi query
if (mysqli_query($koneksi, $query)) {
    echo "Data berhasil diperbarui!<br>";
} else {
    echo "Gagal memperbarui data: " . mysqli_error($koneksi);
}

// Menutup koneksi
mysqli_close($koneksi);
?>