<?php
require("tokenhandler.php");
require("../mysql.php");
function getNameByUUID($uuid){
  require("../mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM bans WHERE UUID = :uuid");
  $stmt->bindParam(":uuid", $uuid, PDO::PARAM_STR);
  $stmt->execute();
  $row = $stmt->fetch();
  return $row["NAME"];
}
$response = array();
$JSONRequest = file_get_contents("php://input");
$request = json_decode($JSONRequest, TRUE);
if(isset($request["token"])){
  $access = new TokenHandler($request["token"]);
  if($access->username != null){
      if(isset($request["search"])){
          $stmt = $mysql->prepare("SELECT * FROM bans WHERE NAME LIKE :searchkey");
          $searchkey = "%".$request["search"]."%";
          $stmt->bindParam(":searchkey", $searchkey, PDO::PARAM_STR);
          $stmt->execute();
          $count = $stmt->rowCount();
          if($count != 0){
            $search = array();
            while ($row = $stmt->fetch()) {
              array_push($search, array("username" => $row["NAME"], "ban" => $row["BANNED"], "mute" => $row["MUTED"], "reason" => $row["REASON"], "end" => $row["END"], "by" => getNameByUUID($row["TEAMUUID"]), "bans" => $row["BANS"], "mutes" => $row["MUTES"], "firstlogin" => $row["FIRSTLOGIN"], "lastlogin" => $row["LASTLOGIN"]));
            }
            $response["status"] = 1;
            $response["msg"] = "OK";
            $response["search"] = $search;
          } else {
            $response["status"] = 0;
            $response["msg"] = "No results";
          }
      } else {
        $response["status"] = 0;
        $response["msg"] = "No search keyword was requested";
      }
  } else {
    $response["status"] = 0;
    $response["msg"] = "Access denied";
  }
} else {
  $response["status"] = 0;
  $response["msg"] = "Invaild request";
}
echo json_encode($response);
 ?>
