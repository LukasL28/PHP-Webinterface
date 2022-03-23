<?php
$host = "localhost";
$name = "USER";
$user = "USER";
$passwort = "PASSWD";
try{
    $mysql = new PDO("mysql:host=$host;dbname=$name", $user, $passwort);
} catch (PDOException $e){
    echo "SQL Error: ".$e->getMessage();
}
 ?>
