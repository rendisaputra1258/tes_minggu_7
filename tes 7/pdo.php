<?php
        $db=new PDO("mysql:dbname=latihan;host=localhost","root","");
        
        $simpan=$db->query("insert into kelas values('','SMA','IPA')");
        var_dump($simpan);
?>