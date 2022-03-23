<?php
$host = "localhost";
$name = "NAME";
$user = "NAME";
$passwort = "PASSWD";
try{
    $mysql = new PDO("mysql:host=$host;dbname=$name", $user, $passwort);
} catch (PDOException $e){
    echo "SQL Error: ".$e->getMessage();
}
 ?>
