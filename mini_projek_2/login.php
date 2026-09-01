<?php
session_start();

// Jika sudah login, langsung lempar ke halaman utama SkateShop.php
if (isset($_SESSION['user_login'])) {
    header("Location: SkateShop.php");
    exit;
}

// Cek data login sederhana (bisa disesuaikan atau dihubungkan ke database jika mau)
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Contoh akun hardcode sederhana untuk admin
    if ($username === 'admin' && $password === '12345') {
        $_SESSION['user_login'] = true;
        $_SESSION['username'] = $username;
        header("Location: SkateShop.php");
        exit;
    } else {
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Manajemen Barang</title>
    <style>
        body { margin: 0; font-family: Arial, sans-serif; background-color: #f0f4f8; display: flex; justify-content: center; align-items: center; height: 100vh; color: #333; }
        .login-card { width: 400px; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-top: 5px solid #4299e1; }
        h2 { color: #2b6cb0; margin-top: 0; text-align: center; }
        label { font-weight: bold; font-size: 13px; color: #2d3748; display: block; margin-top: 12px; }
        input { width: 100%; padding: 10px; margin: 6px 0 15px 0; border: 1px solid #cbd5e0; border-radius: 6px; box-sizing: border-box; background-color: #fff; font-size: 14px; }
        .btn-login { background-color: #3182ce; color: white; border: none; padding: 10px; font-size: 14px; border-radius: 6px; cursor: pointer; font-weight: bold; width: 100%; }
        .btn-login:hover { background-color: #2b6cb0; }
        .error-msg { color: #e53e3e; font-size: 13px; text-align: center; margin-bottom: 10px; font-style: italic; }
    </style>
</head>
<body>

    <div class="login-card">
        <h2>Login Admin</h2>
        <?php if (isset($error)) : ?>
            <div class="error-msg">Username atau Password salah!</div>
        <?php endif; ?>
        <form action="" method="post">
            <label>Username:</label>
            <input type="text" name="username" placeholder="Masukkan username" required>

            <label>Password:</label>
            <input type="password" name="password" placeholder="Masukkan password" required>

            <button type="submit" name="login" class="btn-login">Masuk</button>
        </form>
    </div>

</body>
</html>