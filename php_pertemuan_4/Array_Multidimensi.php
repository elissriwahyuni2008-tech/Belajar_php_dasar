<?php
// Mendefinisikan array multidimensi menggunakan []
$orang = [
    ["Nama" => "elis", "Umur" => 25],
    ["Nama" => "syifa", "Umur" => 30],
    ["Nama" => "melati", "Umur" => 35],
    ["Nama" => "silvi", "Umur" => 35]
];

// Mengakses elemen array multidimensi
echo $orang[3]["Nama"] . " berumur " . $orang[3]["Umur"] . " tahun.<br>"; // Output: silvi berumur 23 tahun.
echo $orang[2]["Nama"] . " berumur " . $orang[2]["Umur"] . " tahun.<br>"; // Output: melati berumur 35 tahun.
?>