<?php

require_once "config.php";

$pesan = "";

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query(
        $conn,
        "SELECT * FROM users
         WHERE email='$email'"
    );

    $user = mysqli_fetch_assoc($query);

    if ($user) {

        if (
            password_verify(
                $password,
                $user['password']
            )
        ) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nama'] = $user['nama'];

            header("Location: dashboard.php");
            exit;

        } else {

            $pesan = "Password salah!";

        }

    } else {

        $pesan = "Email tidak ditemukan!";

    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Login</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container-login">

    <div class="card">

        <h1>Login</h1>

        <p>Silakan masuk ke akun kamu</p>

        <?php if ($pesan != ""): ?>

            <div class="pesan">
                <?= $pesan ?>
            </div>

        <?php endif; ?>

        <form method="POST">

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
                name="login"
            >
                Login
            </button>

        </form>

        <p>
            Belum punya akun?
            <a href="register.php">Register</a>
        </p>

    </div>

</div>

</body>

</html>