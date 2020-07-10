<?php require_once "base/conn.php";
session_start();
	$thequery = "select teamid, password, name, username from user where teamid=$teamchangeid";
$result = $conn->query( $thequery);
$numrow = mysqli_num_rows($result);

	if ($numrow == 0) {
		header("Location: " . $_SERVER['HTTP_REFERER']);
		setcookie ("message", "Invalid Username/Password", 0, "/", ".wmffl.com");
	}
	else {
        $team = $result->fetch(\Doctrine\DBAL\FetchMode::NUMERIC);
		setcookie ("teamid", $team[0], 0, "/", ".wmffl.com");
		setcookie ("teamnum", $team[0], 0, "/", ".wmffl.com");
		setcookie ("user", $team[3], 0, "/", ".wmffl.com");
		setcookie ("message", "", 0, "/", ".wmffl.com");
		setcookie ("fullname", $team[2], 0, "/", ".wmffl.com");
		//$thequery = "update user set lastlog=now() where username='$username'";
        //$result = $conn->query( $thequery);
		header("Location: http://www.wmffl.com");
	}
?>
