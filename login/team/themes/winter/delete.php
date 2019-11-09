<?php
session_start();
if(!isset($_SESSION["4huzhg234lklsdfgu"])){
  header("Location: index.php");
  exit;
} else {
		$expireAfter = 60 * 2;
		if(isset($_SESSION['last_action'])){
			$secondsInactive = time() - $_SESSION['last_action'];
			$expireAfterSeconds = $expireAfter * 60;

			if($secondsInactive >= $expireAfterSeconds){
			   	 session_unset();
       			 session_destroy();
				header("Location: index.php");
				exit;
   			 }
		}
	$_SESSION['last_action'] = time();
	}
  require("rankmanager.php");
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      require("mysql.php");
      $stmt = $mysql->prepare("DELETE FROM accounts WHERE USERNAME = :username");
      $stmt->bindParam(":username", $_GET['username'], PDO::PARAM_STR);
      header("Location: admin.php");
      $stmt->execute();
    ?>
  </body>
</html>
