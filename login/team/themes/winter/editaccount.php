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
  if(getRank($_SESSION["4huzhg234lklsdfgu"]) <= USER) {
    header("Location: team/index.php");
    exit;
  }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Account editieren</title>
      </head>
        <body>
          <?php
            $pw = password_hash($_POST['pw'], PASSWORD_BCRYPT);
            $username = $_POST['benutzername'];
            $email = $_POST['email'];
            $rank = $_POST['rang'];
            $update_username = $_GET['username'];

          if (isset($_POST["submit"])) {
            if (empty($_POST["pw"])) {
              require("mysql.php");
              $stmt = $mysql->prepare("UPDATE accounts SET USERNAME = '$username', EMAIL = '$email', SERVERRANK = '$rank' WHERE USERNAME = '$update_username'");
              $stmt->execute();
            } if (!empty($_POST["pw"])) {
              require("mysql.php");
              $stmt = $mysql->prepare("UPDATE accounts SET USERNAME = '$username', PASSWORD = '$pw', EMAIL = '$email', SERVERRANK = '$rank' WHERE USERNAME = '$update_username'");
              $stmt->execute();
            }
            header("Location: admin.php");
          }
          ?>
          <h2>Account von <?php echo $_GET["username"]; ?></h2>
          <button class="back" onclick="window.open('admin.php','_top');">Zurück</button>
          <div class="modal-footer">
            <form action="editaccount.php?username=<?php echo $_GET["username"]; ?>" method="POST">
              <?php
                require("mysql.php");
                $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :username");
                $stmt->bindParam(":username", $_GET['username'], PDO::PARAM_STR);
                $stmt->execute();
                while($row = $stmt->fetch()) {
              ?>
              <p>Benutzername</p>
                <input type="text" name="benutzername" placeholder="Benutzername" value="<?php echo $_GET['username']; ?>" required><br>
              <p>E-Mail</p>
                <input type="text" name="email" placeholder="E-Mail" value="<?php echo $row['EMAIL']; ?>" required><br>
              <p>Rang</p>
                <input type="text" name="rang" value="<?php //if($row["SERVERRANK"] == 1) {echo 'Admin'; } else if($row["SERVERRANK"] == 0){ echo 'Benutzer'; }
                echo $row['SERVERRANK']?>" required><br>
              <p>Neues Passwort festlegen</p>
                <input type="password" name="pw" id="pw" placeholder="Neues Passwort festlegen"><label class="container"><input type="checkbox" onclick="togglePassword()"><span class="checkmark"></span></label>
                <?php
              }
              ?>
              <input type="submit" class="submit" name="submit" value="Speichern">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
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
    margin-left: 48%;
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
  align-items: center;
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
<style media="screen">
/* Customize the label (the container) */
.container {
width: 50%;
display: block;
position: relative;
cursor: pointer;
font-size: 22px;
-webkit-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
user-select: none;
}

/* Hide the browser's default checkbox */
.container input {
position: absolute;
opacity: 0;
cursor: pointer;
height: 0;
width: 0;
}

/* Create a custom checkbox */
.checkmark {
position: absolute;
top: -37px;
right: -45%;
height: 25px;
width: 25px;
background-color: transparent;
border: 2px solid #ccc;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
background-color: transparent;
border: 2px solid #ccc;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
background-color: transparent;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
content: "";
position: absolute;
display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
left: 9px;
top: 5px;
width: 5px;
height: 10px;
border: solid white;
border-width: 0 3px 3px 0;
-webkit-transform: rotate(45deg);
-ms-transform: rotate(45deg);
transform: rotate(45deg);
}
</style>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script>
function togglePassword() {
  var x = document.getElementById("pw");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
