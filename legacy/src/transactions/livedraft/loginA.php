<?php
require_once "utils/start.php";

// Make sure post variable exists
if (!isset($_POST)) {
    print json_encode(array("code" => -1, "msg" => "ERROR: Please provide username and password"));
    exit();
}

//Make sure username and password have been passed
$userName = $_POST["user"];
$password = $_POST["pass"];
if (!isset($userName) || !isset($password)) {
    print json_encode(array("code"=>-1, "msg"=>"ERROR: Please provide username and password"));
    exit();
}


$query = "SELECT teamid, name, userid, commish FROM user WHERE username=? AND password=md5(?) AND active='Y'";
$result = $conn->executeQuery( $query, array($userName, $password));
$count = $result->fetchAll(\Doctrine\DBAL\FetchMode::ASSOCIATIVE);
$numRows = count($count);
$count = $count[0];

if ($numRows != 1) {
    print json_encode(array("code"=>-1, "msg"=>"ERROR: Invalid username/password combination"));
    exit();
}

$_SESSION["isin"] = true;
$_SESSION["teamnum"] = $count["teamid"];
$_SESSION["usernum"] = $count["userid"];
$_SESSION["fullname"] = $count["name"];


$sql = "SELECT CONCAT(p.lastname, ', ', p.firstname, ' - ', p.pos, ' - ', r.nflteamid)
FROM draftPickHold d JOIN newplayers p ON d.playerid=p.playerid
JOIN nflrosters r on r.playerid=d.playerid and r.dateoff is null
WHERE d.teamid={$count["teamid"]}";
$result2 = $conn->query( $sql);
$playerArray = $result2->fetch(\Doctrine\DBAL\FetchMode::MIXED);

//print json_encode($count);
print json_encode(array("code"=>1, "results"=>$_SESSION, "pre"=>$playerArray));

?>
