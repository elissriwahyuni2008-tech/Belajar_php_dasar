<?php
namespace App\Warehouse;
require_once 'class.php';

session_start();

// Proteksi: Jika belum login, tendang kembali ke halaman login.php
if (!isset($_SESSION['user_login'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['inventory'])) {
    $_SESSION['inventory'] = [
        new HardwareItem("Bor Listrik Bosch", "Peralatan", 750000, 10, "Pcs")
    ];
}

if (isset($_POST['tambah'])) {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = (float)$_POST['price'];
    $stock = (int)$_POST['stock'];
    $unit = $_POST['unit'];

    $_SESSION['inventory'][] = new HardwareItem($name, $category, $price, $stock, $unit);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_POST['hapus'])) {
    $index = (int)$_POST['index'];
    if (isset($_SESSION['inventory'][$index])) {
        unset($_SESSION['inventory'][$index]);
        $_SESSION['inventory'] = array_values($_SESSION['inventory']);
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Manajemen Barang</title>
    <style>
        body { margin: 0; font-family: Arial, sans-serif; background-color: #f0f4f8; color: #333; }
        .header-top { background: linear-gradient(to right, #2b6cb0, #4299e1); color: white; padding: 15px 30px; font-size: 20px; font-weight: bold; box-shadow: 0 2px 5px rgba(0,0,0,0.1); display: flex; justify-content: space-between; align-items: center; }
        .user-info { font-size: 14px; font-weight: normal; display: flex; align-items: center; gap: 15px; }
        .btn-logout { background-color: #e53e3e; color: white; padding: 5px 12px; text-decoration: none; border-radius: 4px; font-size: 12px; font-weight: bold; }
        .btn-logout:hover { background-color: #c53030; }
        .container { max-width: 800px; margin: 30px auto; background: #fff; padding: 25px 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-top: 5px solid #4299e1; }
        h2, h3 { color: #2b6cb0; margin-top: 0; }
        .form-tambah { background: #ebf8ff; padding: 15px; border-radius: 8px; margin-bottom: 25px; border: 1px solid #bee3f8; }
        .form-tambah label { font-weight: bold; font-size: 13px; color: #2d3748; display: block; margin-top: 8px; }
        .form-tambah input { width: 100%; padding: 8px 10px; margin: 4px 0 10px 0; border: 1px solid #cbd5e0; border-radius: 6px; box-sizing: border-box; background-color: #fff; font-size: 14px; }
        .form-tambah button[type="submit"] { width: 100%; padding: 10px; background-color: #3182ce; color: white; font-weight: bold; border: none; border-radius: 6px; cursor: pointer; margin-top: 5px; }
        .form-tambah button[type="submit"]:hover { background-color: #2b6cb0; }
        .table-data { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table-data th, .table-data td { border: 1px solid #e2e8f0; padding: 10px; font-size: 13px; text-align: left; }
        .table-data th { background-color: #3182ce; color: white; }
        .btn-edit { background-color: #d69e2e; color: white; padding: 6px 12px; text-decoration: none; border-radius: 4px; font-size: 12px; font-weight: bold; display: inline-block; }
        .btn-delete { background-color: #e53e3e; color: white; padding: 6px 12px; border: none; border-radius: 4px; font-size: 12px; font-weight: bold; cursor: pointer; display: inline-block; }
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
        <h2>Sistem Manajemen Barang</h2>
        <h3>Tambah Barang Baru</h3>
        <form method="POST" class="form-tambah">
            <label>Nama Barang:</label><input type="text" name="name" required>
            <label>Kategori:</label><input type="text" name="category" required>
            <label>Harga Satuan (Rp):</label><input type="number" name="price" required>
            <label>Stok:</label><input type="number" name="stock" required>
            <label>Satuan Unit:</label><input type="text" name="unit" required>
            <button type="submit" name="tambah">Simpan Barang</button>
        </form>
        <h3>Daftar Inventaris Barang</h3>
        <table class="table-data">
            <thead>
                <tr><th>No</th><th>Detail Barang</th><th>Stok</th><th>Total Nilai Aset</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                <?php if (empty($_SESSION['inventory'])): ?>
                    <tr><td colspan="5" style="text-align: center; color: #777;">Belum ada data barang.</td></tr>
                <?php else: ?>
                    <?php foreach ($_SESSION['inventory'] as $index => $item): ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><strong><?php echo htmlspecialchars($item->getItemDetails()); ?></strong><br><small style="color: #7ff; font-style: italic;"><?php echo htmlspecialchars($item->getDescription()); ?></small></td>
                        <td><?php echo $item->getStock(); ?> <?php echo htmlspecialchars($item->getUnit()); ?></td>
                        <td>Rp <?php echo number_format($item->calculateAssetValue(), 0, ',', '.'); ?></td>
                        <td style="white-space: nowrap;">
                            <a href="edit.php?index=<?php echo $index; ?>" class="btn-edit">Edit</a>
                            <form method="POST" style="background: transparent; padding: 0; margin: 0; display: inline;" onsubmit="return confirm('Yakin ingin menghapus?');">
                                <input type="hidden" name="index" value="<?php echo $index; ?>">
                                <button type="submit" name="hapus" class="btn-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>