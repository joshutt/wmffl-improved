<?php require_once "utils/start.php";

$message = $_REQUEST["message"];
//$last = $_REQUEST["last"];
$league = $_REQUEST["league"];

#print $_SESSION["userid"];
$toUseId = $_SESSION["usernum"];
//$toUseId = $_SESSION["userid"];

if ($league == "true") {
    $toUseId=0;
}

$sql = "INSERT INTO chat (userid, message) VALUES (?,?)";
//print $sql;
$conn->executeQuery($sql, array($toUseId, $message)) or die("Die: " + $conn->error);


include "chat.php";
