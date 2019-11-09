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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="utf-8">
    <title>Edit-Accounts</title>
  </head>
  <body>
    <div class="flex-container animated fadeIn">
          <div class="flex item-1">
            <div class="top">
            <h2>Accounts</h2>
            <button class="back" onclick="window.open('team/index.php','_top');">Zurück</button>
          </div>
            <table class="table table-dark">
              <thead>
                <tr>
                  <th scope="col">Benutzername</th>
                  <th scope="col">E-Mail</th>
                  <th scope="col">Rang</th>
                  <th scope="col">Aktionen</th>
                </tr>
              </thead>
              <?php
              require("mysql.php");
              $stmt = $mysql->prepare("SELECT * FROM accounts");
              $stmt->execute();
              while($row = $stmt->fetch()){
                echo "<tr>";
                echo '<td><strong>'.htmlspecialchars($row["USERNAME"]).'</strong></td>';
                echo '<td><strong>'.htmlspecialchars($row["EMAIL"]).'</strong></td>';
                if($row["SERVERRANK"] == 21){
                  echo '<td>Developer</td>';
                } else if($row["SERVERRANK"] == 1){
                    echo '<td>Admin</td>';
                } else if($row["SERVERRANK"] == 0){
                  echo '<td>Benutzer</td>';
                }
                  echo '<td><a href="editaccount.php?username='.$row["USERNAME"].'""><i class="material-icons"><img class="add" src="img/pencil.png"></i></a> ';
                  echo '<a href="delete.php?username='.$row["USERNAME"].'"><i class="material-icons"><img class="del" src="img/löschen.png"></i></a></td>';
                echo "</tr>";
              }
               ?>
            </table>
          </div>
        </div>
  </body>
</html>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<style media="screen">
/* Luki Style */
.del {
  height: 23px;
}
.add {
  height: 23px;
}
p {
  font-family: 'Nunito', sans-serif;
  text-decoration: none;
  color: rgb(226, 226, 226);
  text-align: center;
  font-size: 20px;
}
h2 {
  padding-top: 3%;
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
    margin-left: 47%;
    margin-top: 1%;
    margin-bottom: 2%;
}
.modal-footer {
  text-align: center;
}
body {
background-color: #343a40;
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
.table-dark td, .table-dark th, .table-dark thead th {
    border-color: #ffffff;
}
</style>
