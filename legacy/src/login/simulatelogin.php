<?
require_once "utils/start.php";
session_start();

if (!$isin || $usernum != 2) {
  //print "Not in: **$isin**<br/>";
  header("Location: http://wmffl.com");
  exit(0);
}


//print "In: **$isin**<br/>";
if (!isset($_REQUEST["teamchangeid"])) {
	$sql = "SELECT teamid, name FROM team ORDER BY name";
    $results = mysqli_query($conn, $sql);
    while ($teamArr = mysqli_fetch_array($results)) {
	    $teamid = $teamArr["teamid"];
	    $name = $teamArr["name"];
	    print "<a href=\"/login/simulatelogin.php?teamchangeid=$teamid\">$name</a><br/>";
	}
} else {
	$teamchangeid = $_REQUEST["teamchangeid"];
	$thequery = "select teamid, password, name, username, userid from user where teamid=$teamchangeid";
    $result = mysqli_query($conn, $thequery);
    $numrow = mysqli_num_rows($result);

	if ($numrow == 0) {
		header("Location: " . $_SERVER['HTTP_REFERER']);
		setcookie ("message", "Invalid Username/Password", 0, "/", ".wmffl.com");
	}
	else {
        $team = mysqli_fetch_row($result);
		$_SESSION["isin"] = true;
		$_SESSION["teamnum"] = $team[0];
		$_SESSION["usernum"] = $team[4];
		$_SESSION["fullname"] = $team[2];
		$_SESSION["message"] = "";
		$_SESSION["user"] = $team[3];
        //$result = mysqli_query($conn, $thequery);
		//header("Location: http://www.wmffl.com");
		print "You are ".$team[2];
	}
}

?>
