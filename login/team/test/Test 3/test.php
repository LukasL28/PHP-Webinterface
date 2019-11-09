<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Test3</title>
  </head>
  <body>
    <?php
    // Das aktuelle datum im vormat TAG:MONAT
    $timestamp = time();
    $datum1 = date("d.m", $timestamp);
    $datum = "01.01";
    $tag = "01";
    $monat = "01";
     ?>
    <?php
    //Dynamischer webseit text
    require("mysql.php");
     $stmt = $mysql->prepare("SELECT * FROM feiertage WHERE datum = :datum");
    $stmt->bindParam(":datum", $datum);
    $stmt->execute();
    $row = $stmt->fetch();
    $bisdatum = $row['bisdatum'];
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

<?php



?>
<h2>Beschreibung: <?php echo $beschreibungtitle;  ?></h2>
<h2>Datum: <?php echo $datum; ?></h2>
<h2>datenbank Datum: <?php echo $date; ?></h2>
<h2>datenbank bisDatum: <?php echo $bisdatum; ?></h2>
<h2>Errechnete Zeitspanne: <?php echo $zeitspanne; ?></h2>


  </body>
</html>
