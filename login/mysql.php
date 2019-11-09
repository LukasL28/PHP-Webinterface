<?php
$host = "localhost";
$name = "Gipfel";
$user = "Gipfel";
$passwort = "hTYJqDgTh1eJeofh";
try{
    $mysql = new PDO("mysql:host=$host;dbname=$name", $user, $passwort);
} catch (PDOException $e){
    echo "SQL Error: ".$e->getMessage();
}
 ?>
