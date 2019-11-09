<?php

define("USER", 0);
define("ADMIN", 1);
define("DEV", 21);

function getRank($username){
    require("mysql.php");
    $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user");
    $stmt->bindParam(":user", $username, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch();
    return $row["SERVERRANK"];
}

function isBanned($username){
    if(getRank($username) == -1){
        return true;
    } else {
        return false;
    }
}

?>
