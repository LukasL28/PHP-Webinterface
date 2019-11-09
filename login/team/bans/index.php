<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Übersicht</title>
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/jquery.sweet-modal.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="js/jquery.sweet-modal.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="css/favicon.ico">
    <meta name="viewport"
      content="width=device-width,
               initial-scale=1.0,
               minimum-scale=1.0">
  </head>
  <?php

  session_start();
  if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit;
  }

  require("./datamanager.php");
  if(isInitialPassword($_SESSION['username'])){
    header("Location: resetpassword.php?name=".$_SESSION['username']);
    exit;
  }

   ?>
  <body>
    <div class="container">
      <div class="sidebar">
        <ul>
          <li class="active"><a href="index.php"><i class="fas fa-home"></i> Übersicht</a></li>
          <?php
          if(isMod($_SESSION["username"])){
            ?>
            <li><a href="bans.php"><i class="fas fa-ban"></i> Bans</a></li>
            <?php
          }
          ?>
          <li><a href="mutes.php"><i class="fas fa-volume-mute"></i> Mutes</a></li>
          <li><a href="livechat.php"><i class="fas fa-comment"></i> Livechat</a></li>
          <?php
          if(isMod($_SESSION["username"])){
            ?>
            <li><a href="reports.php"><i class="fas fa-flag"></i> Reports</a></li>
            <?php
          }
          ?>
          <?php
          if(isAdmin($_SESSION["username"])){
            ?>
            <li><a href="accounts.php"><i class="fas fa-users"></i> Accounts</a></li>
            <li><a href="reasons.php"><i class="fas fa-cogs"></i> Bangründe</a></li>
            <?php
          }
          ?>
          <?php
          if(isMod($_SESSION["username"])){
            ?>
            <li><a href="unbans.php"><i class="fas fa-envelope"></i> Entbannungsanträge</a></li>
            <?php
          }
          ?>
        </ul>
      </div>
      <div class="header">
        <!-- Trigger for mobile devices -->
        <i class="fas fa-bars fa-2x menu mobileicon"></i>
        <a href="logout.php"><i class="fas fa-sign-out-alt fa-2x headericon"></i></a>
      </div>
      <div class="content">
        <!-- START Mobile Menu -->
        <div class="mobilenavbar">
          <nav>
            <ul class="navbar animated bounceInDown">
              <!-- Menu for mobile devices -->
              <li class="active"><a href="index.php"><i class="fas fa-home"></i> Übersicht</a></li>
          <?php
          if(isMod($_SESSION["username"])){
            ?>
            <li><a href="bans.php"><i class="fas fa-ban"></i> Bans</a></li>
            <?php
          }
          ?>
          <li><a href="mutes.php"><i class="fas fa-volume-mute"></i> Mutes</a></li>
          <li><a href="livechat.php"><i class="fas fa-comment"></i> Livechat</a></li>
          <?php
          if(isMod($_SESSION["username"])){
            ?>
            <li><a href="reports.php"><i class="fas fa-flag"></i> Reports</a></li>
            <?php
          }
          ?>
          <?php
          if(isAdmin($_SESSION["username"])){
            ?>
            <li><a href="accounts.php"><i class="fas fa-users"></i> Accounts</a></li>
            <li><a href="reasons.php"><i class="fas fa-cogs"></i> Bangründe</a></li>
            <?php
          }
          ?>
          <?php
          if(isMod($_SESSION["username"])){
            ?>
            <li><a href="unbans.php"><i class="fas fa-envelope"></i> Entbannungsanträge</a></li>
            <?php
          }
          ?>
            </ul>
          </nav>
        </div>
        <script type="text/javascript">
        $(document).ready(function(){
          $('.menu').click(function(){
            $('ul').toggleClass("navactive");
          })
        })
        </script>
        <!-- END Mobile Menu -->
        <div class="flex-container animated fadeIn">
          <div class="flex item-1">
            <h1>Willkommen, <?php echo htmlspecialchars($_SESSION["username"]); ?></h1>
            <p><i class="fas fa-lock"></i> <a href="google-auth.php">Google Authenticator</a>:
              <?php
              if(hasGoogleAuth($_SESSION["username"])){
                echo "Aktiviert";
              } else {
                echo "Deaktiviert";
              }
               ?>
            </p>
            <!-- Currently unsupported feature
            <p><i class="fas fa-user-clock"></i> Letzter Login: 27. April 2019 13:13</p>
          -->
          </div>
        </div>
        <?php
        require("./mysql.php");
        $pstmt = $mysql->prepare("SELECT * FROM bans");
        $pstmt->execute();
        $data = 0;
        while($row = $pstmt->fetch()){
              $data++;
        }
        $mstmt = $mysql->prepare("SELECT * FROM bans WHERE MUTED = 1");
        $mstmt->execute();
        $mutes = 0;
        while($row = $mstmt->fetch()){
              $mutes++;
        }
        $bstmt = $mysql->prepare("SELECT * FROM bans WHERE BANNED = 1");
        $bstmt->execute();
        $bans = 0;
        while($row = $bstmt->fetch()){
              $bans++;
        }
         ?>
        <div class="flex-container animated fadeIn">
          <div class="flex item-1">
            <h1>Spieler
              <div class="flex-icon">
                <i class="fas fa-users fa-2x"></i>
              </div>
            </h1>
            <h1 class="count"><?php echo $data; ?></h1>
          </div>
          <div class="flex item-2">
            <h1>Aktive Bans
              <div class="flex-icon">
                <i class="fas fa-ban fa-2x"></i>
              </div>
            </h1>
            <h1 class="count"><?php echo $bans; ?></h1>
          </div>
          <div class="flex item-3">
            <h1>Aktive Mutes
              <div class="flex-icon">
                <i class="fas fa-volume-mute fa-2x"></i>
              </div>
            </h1>
            <h1 class="count"><?php echo $mutes; ?></h1>
          </div>
        </div>
        <div class="flex-container animated fadeIn">
          <div class="flex item-1">
            <h1>Letzte Aktivitäten</h1>
            <table>
              <tr>
                <th>Spieler</th>
                <th>Von</th>
                <th>Ereignis</th>
                <th>Datum</th>
              </tr>
              <?php
              require("./mysql.php");
              $stmt = $mysql->prepare("SELECT * FROM log ORDER BY DATE DESC LIMIT 4");
              $stmt->execute();
              while ($row = $stmt->fetch()) {
                ?>
                <tr>
                  <td><?php
                  if($row["UUID"] == "KONSOLE"){
                    echo "Konsole";
                  } else {
                    echo UUIDResolve($row["UUID"]);
                  }
                  ?></td>
                  <td><?php
                  if($row["BYUUID"] == "KONSOLE"){
                    echo "Konsole";
                  } else {
                    echo UUIDResolve($row["BYUUID"]);
                  }
                   ?></td>
                  <td><?php
                  //Verfügbare Action Codes (Stand: 25.05.2019)
                  //BAN, MUTE, ADD_WORD_BLACKLIST, DEL_WORD_BLACKLIST, CREATE_CHATLOG, IPBAN_IP, IPBAN_PLAYER, KICK, REPORT, REPORT_OFFLINE, REPORT_ACCEPT, UNBAN_IP, UNBAN_BAN, UNBAN_MUTE,
                  //ADD_WEBACCOUNT, DEL_WEBACCOUNT, AUTOMUTE_ADBLACKLIST, AUTOMUTE_BLACKLIST
                  $action = $row["ACTION"];
                  $note = $row["NOTE"];
                  if($action == "BAN"){
                    echo "wurde gebannt wegen <strong>".getReasonByReasonID($note)."</strong>";
                  } else if($action == "MUTE"){
                    echo "wurde gemutet wegen <strong>".getReasonByReasonID($note)."</strong>";
                  } else if($action == "ADD_WORD_BLACKLIST"){
                    echo "hat das Wort <strong>".$note."</strong> verboten";
                  } else if($action == "DEL_WORD_BLACKLIST"){
                    echo "hat das Wort <strong>".$note."</strong> erlaubt";
                  } else if($action == "CREATE_CHATLOG"){
                    //Prepare Chatlog URL
                    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
           					$finish_url = str_replace("index.php", "public/chatlog.php?id=", $url);
                    echo 'hat einen <a href="'.$finish_url.$note.'">Chatlog</a> erstellt';
                  } else if($action == "IPBAN_IP"){
                    echo "hat die IP <strong>".$note."</strong> gebannt";
                  } else if($action == "IPBAN_PLAYER"){
                    echo "wurde IP gebannt wegen <strong>".getReasonByReasonID($note)."</strong>";
                  } else if($action == "KICK"){
                    echo "wurde gekickt wegen <strong>".$note."</strong>";
                  } else if($action == "REPORT"){
                    echo "wurde gemeldet wegen <strong>".$note."</strong>";
                  } else if($action == "REPORT_OFFLINE"){
                    echo "wurde gemeldet wegen <strong>".$note."</strong>";
                  } else if($action == "REPORT_ACCEPT"){
                    echo "hat einen Report angenommen <strong>#".$note."</strong>";
                  } else if($action == "UNBAN_IP"){
                    echo "hat die IP <strong>".$note."</strong> entbannt";
                  } else if($action == "UNBAN_BAN"){
                    echo "wurde entbannt";
                  } else if($action == "UNBAN_MUTE"){
                    echo "wurde entmutet";
                  } else if($action == "ADD_WEBACCOUNT"){
                    echo "hat einen Webaccount mit dem Rang <strong>".$note."</strong> erstellt";
                  } else if($action == "DEL_WEBACCOUNT"){
                    echo "hat den Webaccount gelöscht";
                  } else if($action == "AUTOMUTE_ADBLACKLIST"){
                    echo "wurde automatisch gemutet wegen Werbung (<strong>".$note."</strong>)";
                  } else if($action == "AUTOMUTE_BLACKLIST"){
                    echo "wurde automatisch gemutet wegen seinem Verhalten (<strong>".$note."</strong>)";
                  }
                  ?></td>
                  <td><?php echo date('d.m.Y H:i',$row["DATE"]/1000); ?></td>
                </tr>
                <?php
              }
               ?>
            </table>
          </div>
          <div class="flex item-2">
            <?php
            //Form submit
            if(isset($_POST["submit"]) && isset($_SESSION["CSRF"])){
              if($_POST["CSRFToken"] != $_SESSION["CSRF"]){
                showModal("ERROR", "CSRF Fehler", "Deine Sitzung ist abgelaufen. Versuche die Seite erneut zu öffnen.");
              } else {
                $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :username");
                $stmt->bindParam(":username", $_SESSION['username'], PDO::PARAM_STR);
                $stmt->execute();
                while($row = $stmt->fetch()){
                  if(password_verify($_POST['currentpw'], $row["PASSWORD"])){
                    if($_POST["newpw"] == $_POST["newpw2"]){
                      $hash = password_hash($_POST["newpw"], PASSWORD_BCRYPT);
                      $stmt = $mysql->prepare("UPDATE accounts SET PASSWORD = :pw WHERE USERNAME = :username");
                      $stmt->bindParam(":pw", $hash, PDO::PARAM_STR);
                      $stmt->bindParam(":username", $_SESSION['username'], PDO::PARAM_STR);
                      $stmt->execute();
                      showModal("SUCCESS", "Erfolgreich", "Dein Passwort wurde erfolgreich geändert.");
                    } else {
                      showModal("ERROR", "Fehler", "Die Passwörter stimmen nicht überein.");
                    }
                  } else {
                    showModal("ERROR", "Fehler", "Dein altes Passwort stimmt nicht.");
                  }
                }
              }
            } else {
              //Erstelle Token wenn Formular nicht abgesendet wurde
              $_SESSION["CSRF"] = generateRandomString(25);
            }
             ?>
            <h1>Passwort ändern</h1>
            <form action="index.php" method="post">
              <input type="hidden" name="CSRFToken" value="<?php echo $_SESSION["CSRF"]; ?>">
              <input type="password" name="currentpw" placeholder="Altes Passwort" autocomplete="current-password" required><br>
              <input type="password" name="newpw" placeholder="Neues Passwort" autocomplete="new-password" required><br>
              <input type="password" name="newpw2" placeholder="Neues Passwort wiederholen" autocomplete="new-password" required><br>
              <button type="submit" name="submit">Passwort ändern</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
