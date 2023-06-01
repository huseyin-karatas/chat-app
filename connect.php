<?php
try {
    $baglan = new PDO("mysql:host=localhost;dbname=chatapp", 'root', 'mysql', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
} catch (PDOException $hata) {
    echo 'Hata: ' . $hata->getMessage();}
    
?>