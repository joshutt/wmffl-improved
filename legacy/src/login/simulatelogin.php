<?php
require_once "utils/start.php";
//session_start();

if (!$isin || $usernum != 2) {
  //print "Not in: **$isin**<br/>";
  header("Location: http://wmffl.com");
  exit(0);
}


//print "In: **$isin**<br/>";
if (!isset($_REQUEST["teamchangeid"])) {
	$sql = "SELECT teamid, name FROM team ORDER BY name";
    $results = $conn->query( $sql);
    while ($teamArr = $results->fetch(\Doctrine\DBAL\FetchMode::MIXED)) {
	    $teamid = $teamArr["teamid"];
	    $name = $teamArr["name"];
	    print "<a href=\"/login/simulatelogin.php?teamchangeid=$teamid\">$name</a><br/>";
	}
} else {
	$teamchangeid = $_REQUEST["teamchangeid"];
	$thequery = "select teamid, password, name, username, userid from user where teamid=$teamchangeid";
    $result = $conn->query( $thequery);
    $teams = $result->fetchAll(\Doctrine\DBAL\FetchMode::NUMERIC);

	if (count($teams) == 0) {
		header("Location: " . $_SERVER['HTTP_REFERER']);
		setcookie ("message", "Invalid Username/Password", 0, "/", ".wmffl.com");
	} else {
        $team = $teams[0];
		$_SESSION["isin"] = true;
		$_SESSION["teamnum"] = $team[0];
		$_SESSION["usernum"] = $team[4];
		$_SESSION["fullname"] = $team[2];
		$_SESSION["message"] = "";
		$_SESSION["user"] = $team[3];
        //$result = $conn->query( $thequery);
		//header("Location: http://www.wmffl.com");
		print "You are ".$team[2];
	}
}
