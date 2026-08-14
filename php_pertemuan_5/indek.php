<?php

require "koneksi.php";


$sql = "SELECT * FROM orang";
$result = mysqli_query($conn, $sql);

$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

foreach($data as $row){
    echo $row["nama"]." ";
    echo $row["umur"]." ";
    echo $row["alamat"]." ";
    echo "<br>";
}
?>