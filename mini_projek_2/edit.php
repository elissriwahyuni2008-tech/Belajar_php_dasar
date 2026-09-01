<?php
namespace App\Warehouse;
require_once 'class.php';

session_start();

// Proteksi: Jika belum login, tendang kembali ke halaman login.php
if (!isset($_SESSION['user_login'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['index']) || !isset($_SESSION['inventory'][$_GET['index']])) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='SkateShop.php';</script>";
    exit();
}

$index = $_GET['index'];
$item = $_SESSION['inventory'][$index];

if (isset($_POST['update'])) {
    $kategori     = $_POST['kategori'];
    $harga_satuan = (float)$_POST['harga_satuan'];
    $stok         = (int)$_POST['stok'];
    $satuan_unit  = $_POST['satuan_unit'];

    $item->updateHardwareData($kategori, $harga_satuan, $stok, $satuan_unit);
    $_SESSION['inventory'][$index] = $item;

    echo "<script>
            alert('Data barang berhasil diubah!');
            window.location='SkateShop.php';
          </script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Manajemen Barang</title>
    <style>
        body { margin: 0; font-family: Arial, sans-serif; background-color: #f0f4f8; color: #333; }
        .header-top { background: linear-gradient(to right, #2b6cb0, #4299e1); color: white; padding: 15px 30px; font-size: 20px; font-weight: bold; box-shadow: 0 2px 5px rgba(0,0,0,0.1); display: flex; justify-content: space-between; align-items: center; }
        .user-info { font-size: 14px; font-weight: normal; display: flex; align-items: center; gap: 15px; }
        .btn-logout { background-color: #e53e3e; color: white; padding: 5px 12px; text-decoration: none; border-radius: 4px; font-size: 12px; font-weight: bold; }
        .btn-logout:hover { background-color: #c53030; }
        .container { max-width: 600px; margin: 30px auto; background: white; padding: 25px 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-top: 5px solid #4299e1; }
        h2 { color: #2b6cb0; margin-top: 0; }
        .back-link { color: #3182ce; text-decoration: none; font-weight: bold; font-size: 14px; display: inline-block; margin-bottom: 15px; }
        .back-link:hover { text-decoration: underline; }
        label { font-weight: bold; font-size: 13px; color: #2d3748; display: block; margin-top: 10px; }
        input { width: 100%; padding: 8px 10px; margin: 6px 0 12px 0; border: 1px solid #cbd5e0; border-radius: 6px; box-sizing: border-box; background-color: #fff; font-size: 14px; }
        input[readonly] { background-color: #edf2f7; color: #718096; }
        .btn-simpan { background-color: #3182ce; color: white; border: none; padding: 10px; font-size: 14px; border-radius: 6px; cursor: pointer; font-weight: bold; width: 100%; margin-top: 10px; }
        .btn-simpan:hover { background-color: #2b6cb0; }
    </style>
</head>
<body>

    <div class="header-top">
        <div>Sistem Manajemen Barang</div>
        <div class="user-info">
            Halo, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>
            <a href="logout.php" class="btn-logout">Logout</a>
        </div>
    </div>

    <div class="container">
        <a href="SkateShop.php" class="back-link">&larr; Kembali ke Data Barang</a>
        <h2>Edit Data Barang</h2>

        <form action="" method="post">
            <label>NAMA BARANG:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($item->getName()); ?>" readonly>

            <label>KATEGORI:</label>
            <input type="text" name="kategori" value="<?php echo htmlspecialchars($item->getCategory()); ?>" required>

            <label>HARGA SATUAN (Rp):</label>
            <input type="number" name="harga_satuan" value="<?php echo htmlspecialchars($item->getPrice()); ?>" required>

            <label>STOK:</label>
            <input type="number" name="stok" value="<?php echo htmlspecialchars($item->getStock()); ?>" required>

            <label>SATUAN UNIT:</label>
            <input type="text" name="satuan_unit" value="<?php echo htmlspecialchars($item->getUnit()); ?>" required>

            <button type="submit" name="update" class="btn-simpan">Simpan Perubahan</button>
        </form>
    </div>

</body>
</html>