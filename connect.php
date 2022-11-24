<?php
    $server = 'localhost';
    $username = 'root';
    $psswrd = '';
    $dbname = 'gestion_des_nfts';
    $connect = new mysqli($server, $username, $psswrd, $dbname);

    if(!$connect) {
        die(mysqli_error($connect));
    }
?>