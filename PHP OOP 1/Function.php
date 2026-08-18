<?php

class Laptop {

    public $merek = "Acer";

    public function tampilkanMerek() {
        echo "Laptop ini merupakan salah satu barang elektronik yang dapat digunakan untuk membantu berbagai kegiatan sehari-hari, seperti mengerjakan tugas sekolah, membuat program, mencari informasi di internet, menonton video, dan melakukan berbagai pekerjaan lainnya. Laptop yang digunakan memiliki merek " . $this->merek . " dan dapat menjadi perangkat yang sangat berguna bagi pelajar maupun masyarakat.";
    }

}

$barang = new Laptop();

$barang->tampilkanMerek();

?>