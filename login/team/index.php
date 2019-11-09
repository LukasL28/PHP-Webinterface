<?php
session_start();
if(!isset($_SESSION["4huzhg234lklsdfgu"])){
  header("Location: ../index.php");
  exit;
} else {
		$expireAfter = 60 * 2;
		if(isset($_SESSION['last_action'])){
			$secondsInactive = time() - $_SESSION['last_action'];
			$expireAfterSeconds = $expireAfter * 60;

			if($secondsInactive >= $expireAfterSeconds){
			   	 session_unset();
       			 session_destroy();
				header("Location: ../index.php");
				exit;
   			 }
		}
	$_SESSION['last_action'] = time();
	}
 ?>

 <?php
 // Das aktuelle datum im vormat TAG:MONAT
 $timestamp = time();
 $datum = date("d.m", $timestamp);
  ?>
 <?php
 //Dynamischer webseit text
 require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM feiertage WHERE datum = :datum");
 $stmt->bindParam(":datum", $datum);
 $stmt->execute();
 $row = $stmt->fetch();
 $beschreibung = $row['beschreibung'];
 $date = $row['datum'];
 $theme = $row['theme']; //url für eine Theme webseit
 $themeaktiv = $row['theme_aktiv']; //0 false 1 true für die Theme webseit
 if ($datum == $date) {
$beschreibungtitle = $beschreibung;
} else {
$beschreibungtitle = "Du hast freie Wahl!"; //Fallback wenn kein event in der datenbank steht
}
  ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php
if ($themeaktiv == 1){
  if ($datum == $date) {
    header("Location: themes/$theme/team");
  }
}
     ?>

    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    <title>KingKürbis.net | TEAM</title>
  </head>
  <body>

    <h2>Willkommen zurück: <?php echo $_SESSION["4huzhg234lklsdfgu"]; ?>!</h2>
    <h3><?php echo $beschreibungtitle; ?></h3>


    <?php
    require("../rankmanager.php");
    //echo "Dein Rang: ".getRank($_SESSION["4huzhg234lklsdfgu"]);
     ?>
    <div class="buttons">
     <?php
     if(getRank($_SESSION["4huzhg234lklsdfgu"]) >= USER) {
      ?>
      <button onclick="window.open('../account.php', '_top');" class="add" type="button" name="button">Account</button>
      <button onclick="window.open('../logout.php', '_top');" class="add" type="button" name="button">Logout</button>
    <?php
    if(getRank($_SESSION["4huzhg234lklsdfgu"]) >= ADMIN) {
     ?>
      <button onclick="window.open('../register.php', '_top');" class="add" type="button" name="button">Account Erstellen</button>
      <button onclick="window.open('../admin.php', '_top');" class="add" type="button" name="button">Admin Pannel</button>
     <?php
   }
     ?>
    </div>
     <?php
     if(getRank($_SESSION["4huzhg234lklsdfgu"]) == DEV) {
     ?>
    <div class="version">
      <h3>Version: 1.55</h3>
      <h2>Dein Rang: <?php getRank($_SESSION["4huzhg234lklsdfgu"]);
      if (getRank($_SESSION["4huzhg234lklsdfgu"]) == 21) {
        echo "Developer";
      } else {
        echo "Fehler!";
      }
      ?>
    </h2>
    </div>
    <?php
  }
     ?>
    <div class="auswahl">
  <a target="_blank" href="tickets">
    <img src="img/ticket.png" alt="Test1" width="600" height="400">
  </a>
  <div class="desc">Ticketsystem</div>
</div>

<div class="auswahl">
  <a target="_blank" href="bans">
    <img src="https://lh3.googleusercontent.com/yn3MG5xRG1BU5zp4jtjZxy6mAXx295EsMakglGpqCdVHeldlsZibRtgOfaH2IP47Dg" alt="Test2" width="600" height="400">
  </a>
  <div class="desc">Bannsystem</div>
</div>

<div target="_top" class="auswahl">
  <a href="#">
    <img src="img/forum.png" alt="Test3" width="600" height="400">
  </a>
  <div class="desc">Forum</div>
  </div>
  <?php
  if(getRank($_SESSION["4huzhg234lklsdfgu"]) >= ADMIN) {
  ?>
  <div target="_top" class="auswahl">
  <a href="test">
      <img src="https://minotar.net/helm/Russeee/100.png" alt="Test4" width="600" height="400">
    </a>
   <div class="desc">Test</div>
  </div>
  <?php
  }

  if(getRank($_SESSION["4huzhg234lklsdfgu"]) >= ADMIN) {
  ?>
  <div target="_top" class="auswahl">
    <a href="/phpmyadmin">
      <img src="https://static.javatpoint.com/phppages/images/phpmyadmin-logo.png" alt="phpmyadmin" width="600" height="400">
    </a>
   <div class="desc">phpMyAdmin</div>
  </div>
  <?php
  }
}
 ?>
 <?php
 if(getRank($_SESSION["4huzhg234lklsdfgu"]) >= DEV) {
 ?>
 <div target="_top" class="auswahl">
   <a href="http://kurbis.ddns.net/login_weihnachten/team/index.php">
     <img src="https://img.icons8.com/cotton/2x/server.png" alt="Weihnachten" width="600" height="400">
   </a>
  <div class="desc">Weihnachten</div>
 </div>
 <?php
 }
?>
  </body>
</html>
<!---
Code and Style by Gipfel (Der WebDev vom Team)
~Also Code by Lukas L. (Der SysAdmin vom Team)
--->
<style>
.logout {
  border: 2px solid #ccc;
  background-color: transparent;
  color: #ccc;
  width: 140px;
  height: 40px;
}

.account {
  border: 2px solid #ccc;
  background-color: transparent;
  color: #ccc;
  width: 140px;
  height: 40px;
}
.admin {
  border: 2px solid #ccc;
  background-color: transparent;
  color: #ccc;
  width: 140px;
  height: 40px;
}
.add {
  border: 2px solid #ccc;
  background-color: transparent;
  color: #ccc;
  width: 140px;
  height: 40px;
}
.add:hover {
  background-color: #ccc;
  color: #000000;
  transition: all 200ms;
  -webkit-transition: all 200ms;
  -moz-transition: all 200ms;
  -o-transition: all 200ms;
}
.account:hover {
  background-color: #ccc;
  color: #000000;
  transition: all 200ms;
  -webkit-transition: all 200ms;
  -moz-transition: all 200ms;
  -o-transition: all 200ms;
}
.logout:hover {
  background-color: #ccc;
  color: #000000;
  transition: all 200ms;
  -webkit-transition: all 200ms;
  -moz-transition: all 200ms;
  -o-transition: all 200ms;
}
.admin:hover {
  background-color: #ccc;
  color: #000000;
  transition: all 200ms;
  -webkit-transition: all 200ms;
  -moz-transition: all 200ms;
  -o-transition: all 200ms;
}
.buttons {
  text-align: center;
}

.desc {
  font-family: 'Nunito', sans-serif;
}

body {
  background-color: #1c1c23;
}
.auswahl {
  border: 2px solid #ccc;
  margin: 5%;
  float: left;
  width: 180px;
}

.auswahl:hover {
  transform: scale(1.05);
  transition: all 300ms;
  -webkit-transition: all 300ms;
  -moz-transition: all 300ms;
  -o-transition: all 300ms
  cursor: pointer;
}

h3 {
  font-family: 'Nunito', sans-serif;
  text-decoration: none;
  color: rgb(226, 226, 226);
  text-align: center;
}
label {
  font-family: 'Nunito', sans-serif;
  text-decoration: none;
  color: rgb(226, 226, 226);
  text-align: center;
}

h2 {
  font-family: 'Nunito', sans-serif;
  text-decoration: none;
  color: rgb(226, 226, 226);
  text-align: center;
}

.auswahl img {
  width: 100%;
  height: auto;
}

.desc {
  padding: 15px;
  text-align: center;
  color: rgb(226, 226, 226);
}

* {
  box-sizing: border-box;
}

.responsive {
  padding: 0 6px;
  float: left;
  width: 24.99999%;
}
.version {
  text-align: right;
}

@media only screen and (max-width: 700px) {
  .responsive {
    width: 49.99999%;
    margin: 6px 0;
  }
}

@media only screen and (max-width: 500px) {
  .responsive {
    width: 100%;
  }
}

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

</style>
