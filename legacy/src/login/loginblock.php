<?php require_once "base/conn.php";

if (isset($teamid)) {
	$thequery = "select teamid, password from user where password='".$teamid."'";
    $result = $conn->query( $thequery)->fetchAll(\Doctrine\DBAL\FetchMode::NUMERIC);
    $numrow = count($result);

	if ($numrow == 0) {
		$teamnum = 0;
	} else {
        $team = $result[0];
		$teamnum = $team[0];
		setcookie ("teamid", $team[1], time()+1800, "/", ".wmffl.com");
		print $teamid;
	}
	
}
?>

<P><FONT Color="Red"><B><?php print $message; ?> </B></FONT></P>

<?php 	if (isset($teamnum) && $teamnum != 0) {
		
?>
	<P>You are logged in<BR>
	<A HREF="logout.php">Log Out</A></P>
<?php 	} else {
?>
	<FORM ACTION="login.php" METHOD="POST">
	Username: <INPUT TYPE="text" NAME="username" size=10><BR>
	Password: <INPUT TYPE="password" NAME="password" WIDTH=10><BR>
	<INPUT TYPE="Submit" NAME="Log In">
	</FORM>
<?php 	}
?>
