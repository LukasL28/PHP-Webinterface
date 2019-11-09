<?php
$host = "localhost";
$name = "Gipfel";
$user = "Gipfel";
$passwort = "cGSGfZBT9XwtP0eh";
try{
    $mysql = new PDO("mysql:host=$host;dbname=$name", $user, $passwort);
} catch (PDOException $e){
    echo "SQL Error: ".$e->getMessage();
}
 ?>
