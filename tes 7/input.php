<?php

include "connection.php";
// function inputSiswa($input=[]){
//     global $db;
//     $input=$db->exec("insert into siswa(nama_siswa,sekolah,motivasi) values('".$_POST["nama_siswa"]."','".$_POST["sekolah"]."','".$_POST["motivasi"]."')");
// }
// inputSiswa();

$input=$db->exec("insert into siswa(nama_siswa) values('".$_POST["nama_siswa"]."','".$_POST["sekolah"]."','".$_POST["motivasi"]."')");
if ($input) {
    header("Location:index.php");
}
var_dump($input);


$input=$db->exec("insert into tim(nama_tim) values('".$_POST["nama_tim"]."')");
if ($input) {
    header("Location:index.php");
}

// var_dump($_POST);