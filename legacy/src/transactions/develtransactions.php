<?php require_once "utils/start.php";

function trade($teamid, $date) {
	$tradequery="select t1.tradegroup, t1.date, tm1.name as TeamFrom, ";
	$tradequery.="p.lastname, p.firstname, p.pos, p.team, t1.other, tm2.name as TeamTo ";
    $tradequery.="from trade t1 ";
    $tradequery.="left join trade t2 on t1.tradegroup=t2.tradegroup and t1.teamfromid<>t2.teamfromid ";
    $tradequery.="join teamnames tm1 on t1.teamfromid=tm1.teamid ";
    $tradequery.="join teamnames tm2 on t1.teamtoid=tm2.teamid ";
    $tradequery.="join weekmap wm on tm1.season=wm.season ";
    $tradequery.="left join newplayers p on p.playerid=t1.playerid ";
	$tradequery.="where (t1.TeamFromid=$teamid or t1.TeamToid=$teamid) ";
	$tradequery.="and t1.date='$date' ";
    $tradequery.="and '$date' between wm.startDate and wm.enddate ";
	$tradequery.="group by t1.tradegroup, abs(tm1.teamid-$teamid), p.lastname ";

    $results = $conn->query( $tradequery);
	$oldgroup = 0;
    $numRows = mysqli_num_rows($results);
    //print $tradequery;
    $firstteam = $teamid;
    while (list($group, $date, $TeamFrom, $lastname, $firstname, $position, $nflteam, $other) = $results->fetch(\Doctrine\DBAL\FetchMode::NUMERIC)) {
		if ($oldgroup != $group) {
			print "<LI>Traded ";
			$oldgroup = $group;
			$firstteam = $TeamFrom;
			$firstplayer = TRUE;
		}
		if ($firstteam != $TeamFrom) {
			print " to the $TeamFrom in exchange for ";
			$firstplayer = TRUE;
			$firstteam = $TeamFrom;
		}
		if (!$firstplayer) {print ", ";}
        if ($other) {print $other;}
		else print "$firstname $lastname ($position-$nflteam)";
		$firstplayer = FALSE;
	}
}


	$thequery = "SELECT DATE_FORMAT(max(date), '%m/%e/%Y'), DATE_FORMAT(max(date),'%m'), DATE_FORMAT(max(date),'%Y') FROM transactions";
$results = $conn->query( $thequery);
list($lastupdate, $themonth, $theyear) = $results->fetch(\Doctrine\DBAL\FetchMode::NUMERIC);

if (isset($_GET["month"])) $themonth = $_GET["month"];
if (isset($_GET["year"])) $theyear = $_GET["year"];
//	if (!isset($_GET["year"])) $_GET["year"]=2002;

    $title = "WMFFL Transactions";
	include "base/menu.php";
?>

<H1 ALIGN=Center>Transactions</H1>
<H5 ALIGN=Center>Last Updated <?print $lastupdate;?></H5>
<HR size = "1">
<!--
<FORM ACTION="transactions.php" METHOD="GET">
<SELECT NAME="month">
	<OPTION VALUE="01"<?php if ($themonth=='01') print "SELECTED";?>>January</OPTION>
	<OPTION VALUE="02"<?php if ($themonth=='02') print "SELECTED";?>>February</OPTION>
	<OPTION VALUE="03"<?php if ($themonth=='03') print "SELECTED";?>>March</OPTION>
	<OPTION VALUE="04"<?php if ($themonth=='04') print "SELECTED";?>>April</OPTION>
	<OPTION VALUE="05"<?php if ($themonth=='05') print "SELECTED";?>>May</OPTION>
	<OPTION VALUE="06"<?php if ($themonth=='06') print "SELECTED";?>>June</OPTION>
	<OPTION VALUE="07"<?php if ($themonth=='07') print "SELECTED";?>>July</OPTION>
	<OPTION VALUE="08"<?php if ($themonth=='08') print "SELECTED";?>>August</OPTION>
	<OPTION VALUE="09"<?php if ($themonth=='09') print "SELECTED";?>>September</OPTION>
	<OPTION VALUE="10"<?php if ($themonth=='10') print "SELECTED";?>>October</OPTION>
	<OPTION VALUE="11"<?php if ($themonth=='11') print "SELECTED";?>>November</OPTION>
	<OPTION VALUE="12"<?php if ($themonth=='12') print "SELECTED";?>>December</OPTION>
</SELECT>
<INPUT TYPE="hidden" NAME="year" VALUE="2001">
-->
<!--
<SELECT NAME="year">
	<OPTION VALUE="2001">This Season</OPTION>
	<OPTION VALUE="2000">2000 Season</OPTION>
</SELECT>
-->
<!--
<INPUT TYPE="submit" NAME="submit" VALUE="Search">
</FORM>
-->
<?php
	include "transactions/transmenu.php";
	//include "transactions/transmenu.html";

//	if (!isset($_POST["month"])) $_POST["month"]=$themonth;
//	if (!isset($_POST["year"])) $_POST["year"]=2001;

	// Create the query
	$thequery="SELECT DATE_FORMAT(t.date, '%M %e, %Y'), m.name, t.method, concat(p.firstname, ' ', p.lastname), p.pos, p.team, m.teamid, DATE_FORMAT(t.date, '%Y-%m-%d') ";
	//$thequery .= "FROM transactions t, team m, players p ";
	$thequery .= "FROM transactions t, teamnames m, newplayers p ";
	$thequery .= "WHERE t.teamid=m.teamid AND t.playerid=p.playerid ";
    $thequery .= "AND m.season=$theyear ";
//$thequery .= "AND t.date BETWEEN '".$_GET["year"]."-".$themonth."-01' AND ";
	if ($themonth > 8) {
		$thequery .= "AND t.date BETWEEN '".$theyear."-".$themonth."-01' AND ";
		$thequery .= "'".$theyear."-".$themonth."-31 23:59:59.99999' ";
	} else {
		$thequery .= "AND t.date BETWEEN '".$theyear."-01-01' AND ";
		$thequery .= "'".$theyear."-08-31 23:59:59.99999' ";
	}
//	$thequery .= "'".HTTP_POST_VARS["year"]."-".$_POST["month"]."-31' ";
//	$thequery .= "ORDER BY t.date DESC, m.name, t.method, p.lastname";
	$thequery .= "ORDER BY DATE_FORMAT(t.date, '%Y/%m/%d') DESC, m.name, t.method, p.lastname";

$results = $conn->query( $thequery) or die("Error: " . $conn->error);
	$first = TRUE;
    $olddate = "";
    $oldteam = "";
    $oldmethod = "";
while (list($date, $teamname, $method, $player, $position, $nflteam, $teamid, $rawdate) = $results->fetch(\Doctrine\DBAL\FetchMode::NUMERIC)) {
		$change = FALSE;
		if ($olddate != $date) {
			if (!$first) {
				print "</UL></UL>";
			}
			$first = FALSE;
			print "<B><I>$date</I></B><UL>";
			$olddate = $date;
			$change = TRUE;
			$firstplayer = TRUE;
			$tradeonce = FALSE;
		}
		if ($oldteam != $teamname || $change) {
			if (!$change) print "</UL>";
			print "<LI><B>$teamname</B><UL>";
			$oldteam = $teamname;
			$change = TRUE;
			$firstplayer = TRUE;
			$tradeonce = FALSE;
		}
		if ($oldmethod != $method || $change) {
			switch($method) {
				case 'Cut':  print "<LI>Dropped "; break;
				case 'Sign': print "<LI>Picked Up "; break;
				case 'Trade':
					if ($tradeonce) continue 2;
					trade($teamid, $rawdate); 
					$change = TRUE;
					$oldmethod = "";
					$tradeonce = TRUE;
					continue 2;
				case 'Fire': print "<LI>Fired "; break;
				case 'Hire': print "<LI>Hired "; break;
			}
//			print "<LI>$method ";
			$oldmethod = $method;
			$change = TRUE;
			$firstplayer = TRUE;
		}
		if (!$firstplayer) print ", ";
		print "$player ($position-$nflteam)";
		$firstplayer = FALSE;
	}
	print "</UL></UL>";

	include "base/footer.html";
?>

