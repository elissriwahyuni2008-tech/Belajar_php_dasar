<?php

$orang = [
    ["Nama" => "elis", "Umur" => 19],
    ["Nama" => "syifa", "Umur" => 35],
    ["Nama" => "silvi", "Umur" => 24]
];

foreach ($orang as $individu) {
    echo $individu["Nama"] . " berumur " . $individu["Umur"] . " tahun.<br>";
}

?>