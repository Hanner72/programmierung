<?php

$host = "localhost";
$name = "bt_sb_mit_login";
$user = "root";
$passwort = "";

try{
    $mysql = new PDO("mysql:host=$host;dbname=$name", $user, $passwort);
} catch (PDOException $e){
    echo "SQL Error: ".$e->getMessage();
}

date_default_timezone_set("Europe/Berlin");

?>