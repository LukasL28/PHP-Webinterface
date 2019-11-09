<?php
session_start();
if(!isset($_SESSION["4huzhg234lklsdfgu"])){
  header("Location: team/index.php");
  exit;
} else {
		$expireAfter = 60 * 2;
		if(isset($_SESSION['last_action'])){
			$secondsInactive = time() - $_SESSION['last_action'];
			$expireAfterSeconds = $expireAfter * 60;

			if($secondsInactive >= $expireAfterSeconds){
			   	 session_unset();
       			 session_destroy();
				header("Location: team/index.php");
				exit;
   			 }
		}
	$_SESSION['last_action'] = time();
	}

require("rankmanager.php");
if(getRank($_SESSION["4huzhg234lklsdfgu"]) <= USER) {
  header("Location: team/index.php");
  exit;
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Account erstellen</title>
  </head>
  <body>
    <?php
    if(isset($_POST["register"])){
      require("mysql.php");
      $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user"); //Username überprüfen
      $stmt->bindParam(":user", $_POST["username"]);
      $stmt->execute();
      $count = $stmt->rowCount();
      if($count == 0){
        //Username ist frei
        $stmt = $mysql->prepare("SELECT * FROM accounts WHERE EMAIL = :email"); //Email überprüfen
        $stmt->bindParam(":email", $_POST["email"]);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count == 0){
          if($_POST["pw"] == $_POST["pw2"]){
            //User anlegen
            $stmt = $mysql->prepare("INSERT INTO accounts (USERNAME, PASSWORD, EMAIL, TOKEN, SERVERRANK) VALUES (:user, :pw, :email, null, 0)");
            $stmt->bindParam(":user", $_POST["username"]);
            $hash = password_hash($_POST["pw"], PASSWORD_BCRYPT);
            $stmt->bindParam(":pw", $hash);
            $stmt->bindParam(":email", $_POST["email"]);
            $stmt->execute();
            echo "Dein Account wurde angelegt";
			header("Location: team/index.php");
          } else {
            echo "Die Passwörter stimmen nicht überein";
          }
        } else {
          echo "Email bereits vergeben";
        }
      } else {
        echo "Der Username ist bereits vergeben";
      }
    }
     ?>
     <h2>Erstelle einen Account</h2>
     <div class="modal-footer">
     <button class="back" onclick="window.open('team/index.php','_top');">Zurück</button>
     <form action="register.php" method="POST">
      <div class="formular">
       <h2>Benutzername</h2>
          <input type="text" name="username" placeholder="Benutzername" required>
       <h2>E-Mail</h2>
          <input type="email" name="email" placeholder="E-Mail" required>
       <h2>Passwort</h2>
          <input type="password" name="pw" placeholder="Passwort" required>
       <h2>Passwort bestätigen</h2>
         <input type="password" name="pw2" id="pw2" placeholder="Passwort bestätigen" required>
         <input type="submit" class="submit" name="register" value="Erstellen">
     </div>
   </form>
  </body>
</html>
<style media="screen">
/* Luki Style */
p {
  font-family: 'Nunito', sans-serif;
  text-decoration: none;
  color: rgb(226, 226, 226);
  text-align: center;
  font-size: 20px;
}
h2 {
  font-family: 'Nunito', sans-serif;
  text-decoration: none;
  color: rgb(226, 226, 226);
  text-align: center;
}
.back {
    font-size: 137.4%;
    border: 2px solid #ccc;
    background-color: transparent;
    color: #ccc;
    width: 90px;
    height: 40px;
}
.modal-footer {
  text-align: center;
}
body {
background-color: #1c1c23;
}
.back:hover {
  background-color: #ccc;
  color: #000000;
  transition: all 200ms;
  -webkit-transition: all 200ms;
  -moz-transition: all 200ms;
  -o-transition: all 200ms;
  cursor: pointer;
}
input {
  text-align: center;
  border-radius: 15px;
  background: transparent;
  border: 2px solid #ccc;
  color: #f2f2f2;
  font-size: 21px;
  height: 30px;
  line-height: 30px;
  outline: 2px;
  outline-color: #ccc;
  width: 50%;
  height: 40px;
}
.submit {
  height: 45px;
  margin-top: 15px;
}
.submit:hover {
  background-color: #ffffff;
  color: #000000;
  transition: all 600ms;
  -webkit-transition: all 600ms;
  -moz-transition: all 600ms;
  -o-transition: all 600ms;
  cursor: pointer;
}
</style>
