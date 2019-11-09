<?php
/////////////////////////////////////////////////
// Stelle hier deine Datenbankverbindung ein!
/////////////////////////////////////////////////
$host = "localhost";
$name = "bansystem";
$user = "bansystem";
$passwort = "waaaqXAunG7yqaA6";
/////////////////////////////////////////////////
try{
    $mysql = new PDO("mysql:host=$host;dbname=$name", $user, $passwort);
} catch (PDOException $e){
    echo "SQL Error: ".$e->getMessage();
}
 ?>
