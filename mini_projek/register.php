<?php

require_once "config.php";

$pesan = "";

if (isset($_POST['register'])) {

    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $password_hash = password_hash(
        $password,
        PASSWORD_DEFAULT
    );

    $cek = mysqli_query(
        $conn,
        "SELECT * FROM users WHERE email='$email'"
    );

    if (mysqli_num_rows($cek) > 0) {

        $pesan = "Email sudah terdaftar!";

    } else {

        $query = mysqli_query(
            $conn,
            "INSERT INTO users
            (nama, email, password)
            VALUES
            ('$nama', '$email', '$password_hash')"
        );

        if ($query) {

            $pesan = "Registrasi berhasil! Silakan login.";

        } else {

            $pesan = "Registrasi gagal.";

        }
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Register</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container-login">

    <div class="card">

        <h1>Register</h1>

        <p>Buat akun baru</p>

        <?php if ($pesan != ""): ?>

            <div class="pesan">
                <?= $pesan ?>
            </div>

        <?php endif; ?>

        <form method="POST">

            <label>Nama</label>

            <input
                type="text"
                name="nama"
                placeholder="Masukkan nama"
                required
            >

            <label>Email</label>

            <input
                type="email"
                name="email"
                placeholder="Masukkan email"
                required
            >

            <label>Password</label>

            <input
                type="password"
                name="password"
                placeholder="Masukkan password"
                required
            >

            <button
                type="submit"
                name="register"
            >
                Register
            </button>

        </form>

        <p>
            Sudah punya akun?
            <a href="login.php">Login</a>
        </p>

    </div>

</div>

</body>

</html>