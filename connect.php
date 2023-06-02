<?php
try {
    $baglan = new PDO("mysql:host=localhost;dbname=chatapp", 'root', 'mysql', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
} catch (PDOException $hata) {
    echo 'Hata: ' . $hata->getMessage();}

    function fetch_user_last_activity($user_id, $baglan){
        $query = "SELECT * FROM user_details WHERE user_id = '$user_id' ORDER BY last_activity DESC LIMIT 1 ";

        $statement = $baglan->prepare($query);
        $statement->execute();
        $result =  $statement->fetchAll();

        foreach($result as $row){
            return $row['last_activity'];
        }
    }