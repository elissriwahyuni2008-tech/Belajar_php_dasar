<?php
include 'SkateShop.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $hapus = mysqli_query($koneksi, "DELETE FROM tbl_barang WHERE id = '$id'");

    if ($hapus) {
        echo "<script>
                alert('Data berhasil dihapus!');
                window.location='SkateShop.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data');
                window.location='SkateShop.php';
              </script>";
    }
}
?>