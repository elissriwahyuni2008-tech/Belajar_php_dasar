<?php

session_start();

$host = "localhost";
$user = "root";
$password = "";
$database = "mini_project";

$conn = mysqli_connect(
    $host,
    $user,
    $password,
    $database
);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

?>