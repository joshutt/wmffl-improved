<?php function process($array, $word = "pick")
{
    $playerlist = array();
    if (is_array($array)) {
//		print("<ul>\n");
//		$playerlist = array();
        while (list($key, $val) = each($array)) {
            if ($val == null || $val == "") continue;
            if (substr($key, 0, strlen($word)) != $word) continue;
            $playerlist[] = $val;
//			print("<li> $val ");
        }
    }
    return $playerlist;
}

/*
function array_keys ($arr, $term="") {
    $t = array();
    while (list($k,$v) = each($arr)) {
        if ($term && $v != $term)
            continue;
            $t[] = $k;
        }
        return $t;
}
*/
// establish connection
require_once "utils/start.php";

$MAXPLAYERS = 25;

if (!isset($ErrorMessage)) {
    $ErrorMessage = "";
}

// Determine if this is the waiver period
$waiverSQL = "SELECT IF(now()>ActivationDue,1,0) AS 'WaiverPeriod', ";
$waiverSQL .= "season, week ";
$waiverSQL .= "FROM weekmap WHERE now() BETWEEN startdate AND enddate";
$result = $conn->query($waiverSQL) or die("Error: " . $conn->error);
list($isWaiver, $season, $week) = $result->fetch(\Doctrine\DBAL\FetchMode::NUMERIC);
if ($week == 0) {
    $isWaiver = 1;
}

$displayWaiver = false;
$playlist = array();
$waiveList = array();
$droparray = array();
if ($submit == "Confirm") {
//    print "In Confirm<br>";
    $playercount = 0;
    $listcount = 0;
    while (list($key, $val) = each($_POST)) {
        $com = substr($key, 0, 4);
        //      print "$key - $com - $val<br>";
        if ($com == "keep") {
            if ($val == "n") {
                $droparray[] = substr($key, 4);
            } else {
                $playercount++;
            }
        } else if ($com == "pick" && $val == 'y') {
//			putEnv("TZ=US/Eastern");	
            //$diff = mktime(12,0,0,8,20,2002) - time();
            //$diff = mktime(12,15,0,12,21,2002) - time();
//			$diff = mktime(12,15,0,12,20,2004) - time();
            //$diff = time()-mktime(12,0,0,8,26,2003);
//			if ($diff < 0) {
//				$ErrorMessage = "Pickups are no longer allowed this season";
            //$ErrorMessage = "Pickups are not allowed until Noon (EDT) on Tuesday, August 26th";
            //}
            //if ($week == 0) {
            //    $ErrorMessage = "Pickups are not allowed until after the draft";
            //} else if ($week == 16 && $isWaiver == 1) {
            if ($week == 16 && $isWaiver == 1) {
                $ErrorMessage = "Pickups are no longer allowed this season";
            }
            $playercount++;
            $playlist[] = substr($key, 4);
//			$pickup[] = substr($key,4);
        } else if ($com == "prio") {
            $displayWaiver = true;
            if ($val != "n") {
                $waiveList[$val] = substr($key, 4);
            }
        }
    }
    if ($playercount > $MAXPLAYERS) {
        $ErrorMessage = "That would give you $playercount players on your roster!!  You must drop someone!! <BR>";
    }

    // Query to see if allowed to aquire
    $allowedTran = "SELECT p.paid, tp.TotalPts - tp.ProtectionPts - tp.TransPts as 'remain'
FROM transpoints tp
JOIN paid p on tp.teamid=p.teamid and tp.season=p.season
WHERE tp.teamid=$teamnum and tp.season=$season";
    $aResult = $conn->query($allowedTran) or die("Unable to get transactions: " . $conn->error);
    list($paid, $remainTrans) = $aResult->fetch(\Doctrine\DBAL\FetchMode::NUMERIC);

    //$paid = true;
    //$remainTrans = 994;
    if (sizeof($playlist) > $remainTrans && !$paid) {
        $ErrorMessage .= "You haven't paid entry fee and are out of free transactions.  No pick-ups allowed. <br />";
    }

    //  print "An error: $ErrorMessage<br>";
    if (!isset($ErrorMessage) || $ErrorMessage == "") {
//        print "No Error so far<br>";
        $thequery = "INSERT INTO roster (Playerid, Teamid, Dateon) VALUES ";
        $dropquery = "UPDATE roster SET DateOff=now() WHERE DateOff is null AND (";
        $checkquery = "SELECT r.playerid, p.lastname, p.firstname FROM roster r, newplayers p WHERE r.DateOff is null and r.playerid=p.playerid and r.Playerid=";
        $transquery = "INSERT INTO transactions (Teamid, Playerid, Method, Date) VALUES ";
        //$ptsquery = "UPDATE transpoints SET PtsLeft=PtsLeft+".sizeof($playlist)." WHERE teamid=$teamnum";
        $ptsquery = "UPDATE transpoints SET TransPts=Transpts+" . sizeof($playlist) . " WHERE teamid=$teamnum AND season=$season";
        $waiveClear = "DELETE FROM waiverpicks WHERE season=$season AND week=$week AND teamid=$teamnum";
        $waivequery = "INSERT INTO waiverpicks (teamid, season, week, playerid, priority) VALUES ";

        $first = TRUE;
        for ($i = 0; $i < sizeof($playlist); $i++) {
            $result = $conn->query($checkquery . $playlist[$i])->fetchAll(\Doctrine\DBAL\FetchMode::NUMERIC)
                        or die ("Check Query Failed: " . $playlist[$i]);
            if (count($result) != 0) {
                $rst = $result[0];
                $ErrorMessage .= $rst[2] . " " . $rst[1] . " is already on a roster!!<BR>";
            } else {
                if (!$first) {
                    $thequery .= ", ";
                    $transquery .= ", ";
                }
                $first = FALSE;
                $thequery .= "(" . $playlist[$i] . ", $teamnum, now())";
                $transquery .= "($teamnum, " . $playlist[$i] . ", 'Sign', now())";
            }
        }

        // Create the drop queries
        $nopicks = $first;
        for ($i = 0; $i < sizeof($droparray); $i++) {
            $dropquery .= "playerid=" . $droparray[$i] . " OR ";
            if (!$first) {
                $transquery .= ", ";
            }
            $first = FALSE;
            $transquery .= "($teamnum, " . $droparray[$i] . ", 'Cut', now())";
        }
        $dropquery .= "1=2)";

        // Create the waiver queries
        ksort($waiveList);
        $priID = 1;
        $firstW = TRUE;
        foreach ($waiveList as $playID) {
            //    print "build waivequery: $playID<br>";
            if (!$firstW) {
                $waivequery .= ", ";
            }
            $firstW = FALSE;
            $waivequery .= "($teamnum, $season, $week, ";
            $waivequery .= "$playID, $priID) ";
            $priID++;
        }

        // Actually Do queries here
        //print "Any Errors? $ErrorMessage<br>";
        if (!isset($ErrorMessage) || $ErrorMessage == "") {
            $conn->query($dropquery) or die ("Drop Query Failed");
            if (!$nopicks) {
                $conn->query($thequery) or die ("Insert Query Failed");
                $conn->query($ptsquery) or die ("Pts Query Failed");
            }
            if (!$first) {
                $conn->query($transquery) or die ("Transaction Query Failed");
            }
            //  print "In other queries<br>";
            //if ($isWaiver == 1) {
            if ($displayWaiver) {
                //    print "Doing this query<br>";
                $conn->query($waiveClear) or die ("Clearing Waiver Failed: " . $conn->error);
                if (!$firstW) {
                    $conn->query($waivequery) or die ("Waiver Query Failed<br/>$waivequery<br/>" . $conn->error);
                }
            }
            // Forward to completion page
            header("Location: transactions.php");

        }
        //print "Down here<br>";
    }

} else {
    $playlist = process($_POST);
}

$waveCount = 0;
$wavePlayers = array();
//if ($isWaiver == 1) {
//  $displayWaiver = true;
$waiverSQL = "SELECT w.playerid, p.lastname, p.firstname, p.team, ";
$waiverSQL .= "p.pos, w.priority FROM waiverpicks w, newplayers p ";
$waiverSQL .= "WHERE w.playerid=p.playerid AND teamid=$teamnum ";
$waiverSQL .= "AND season=$season AND week=$week ";
$waiverSQL .= "ORDER BY w.priority ";
$result = $conn->query($waiverSQL) or die("Dead: " + $conn->error);
$waveCount = 0;
while ($wavePlayers[$waveCount] = $result->fetch(\Doctrine\DBAL\FetchMode::NUMERIC)) {
    $waveCount++;
    $displayWaiver = true;
}
array_pop($wavePlayers);
//} else {
//$waiverSQL = "SELECT DISTINCT playerid FROM roster r, weekmap w WHERE r.dateoff BETWEEN w.startdate and now() AND w.season=$currentSeason AND w.week=$currentWeek";

$waiverSQL = <<<EOD
SELECT DISTINCT playerid FROM roster r, weekmap w WHERE  
((r.dateoff between w.startdate and now() and now() < DATE_ADD(w.startdate, INTERVAL 7 DAY)) OR (w.week=1 AND r.dateoff between DATE_SUB(w.enddate, INTERVAL 7 DAY) AND now()))
AND w.season=$currentSeason AND w.week=$currentWeek
UNION
select DISTINCT r.playerid from nflrosters r
JOIN nflgames g on r.nflteamid in (g.homeTeam, g.roadTeam)
where r.dateoff is null and g.season=$currentSeason and g.week=$currentWeek and now() >= g.kickoff
EOD;

//$waiverSQL = "SELECT DISTINCT playerid FROM roster r, weekmap w WHERE r.dateoff BETWEEN w.startdate and now() AND w.season=$season AND w.week=$week";
//    $waiverSQL .= " AND r.dateoff > '2004-09-07 11:00:00' ";
$result = $conn->query($waiverSQL) or die("Dead: " + $conn->error);
$wavePlayCount = 1;
$waiveElgPlayers = array();
while ($row = $result->fetch(\Doctrine\DBAL\FetchMode::NUMERIC)) {
    //error_log("Row: ".print_r($row, true));
    $waiveElgPlayers[$wavePlayCount] = $row[0];
    //error_log("Array: ".is_array($waiveElgPlayers));
    //error_log(print_r($waiveElgPlayers, true));
    $wavePlayCount++;
}
//error_log("Waive Elg: ".print_r($waiveElgPlayers, true));


// Generate query to list players
$thequery = "SELECT playerid, lastname, firstname, team, pos, 0 as 'isWaive' FROM newplayers WHERE playerid in (0 ";
for ($i = 0; $i < sizeof($playlist); $i++) {
    $thequery .= ", " . $playlist[$i];
}
$thequery .= ")";

// Get info about players to pickup
$result = $conn->query($thequery) or die ("Query 1 Failed");
$i = 0;
while ($pickups[$i] = $result->fetch(\Doctrine\DBAL\FetchMode::NUMERIC)) {
    if ($isWaiver == 1) {
        $pickups[$i][5] = 1;
        $waveCount++;
    } else {
        //error_log("Pickups: ".print_r($pickups, true));
        $searcher = $pickups[$i][0];
//        print $searcher;
//        print array_search($pickups[$i][0], $waiveElgPlayers);
//        print array_search($searcher, array_reverse($waiveElgPlayers));
        if (array_search($pickups[$i][0], $waiveElgPlayers)) {
            //        print "Inele";
            $pickups[$i][5] = 1;
            $waveCount++;
        } else {
            //          print "Nope";
        }

    }
    $i++;
}
//print_r($pickups);
//print_r($waiveElgPlayers);
//$waveCount += $i;

// Get info about current roster
$thequery = "select p.playerid, p.lastname, p.firstname, p.team, p.pos from newplayers p, roster r, team t where p.playerid=r.playerid and r.teamid=t.teamid and r.dateoff is null and t.teamid=$teamnum order by p.pos, p.lastname";
$result = $conn->query($thequery) or die ("Query 2 Failed");
$i = 0;
while ($currentroster[$i] = $result->fetch(\Doctrine\DBAL\FetchMode::NUMERIC)) {
    $i++;
}


// Get team info
//$thequery = "select count(*), t.preptsleft-t.ptsleft from roster r, players p, transpoints t where r.playerid=p.playerid and r.teamid=t.teamid and r.teamid=$teamnum and r.dateoff is null and p.position<>'HC' group by t.teamid";
$thequery = "select count(*), t.totalpts-t.protectionpts-t.transpts from roster r, newplayers p, transpoints t where r.playerid=p.playerid and r.teamid=t.teamid and r.teamid=$teamnum and r.dateoff is null and p.pos<>'HC' and t.season=$season group by t.teamid";
$result = $conn->query($thequery) or die ("Query 3 Failed");
list($numplayers, $ptsleft) = $result->fetch(\Doctrine\DBAL\FetchMode::NUMERIC);
?>


<HTML>
<HEAD>
    <TITLE>Confirm Transaction</TITLE>
</HEAD>

<?php include "base/menu.php"; ?>

<H1 ALIGN=Center>Confirm Transaction</H1>
<HR size="1">

<?php if ($isin) {
    ?>

    <P>Step 4: Check your available roster room and transaction points. You will not
        be allowed to exceed the roster limit of <?php print $MAXPLAYERS; ?>. If you use
        more transaction points then you have the $1 fee will automaticlly be debited
        from your account.</P>

    <P>Step 5: Remove any players that you do not want to pick up, by changing the "Add"
        label to "Leave".</P>

    <P>Step 6: Drop any players from your current roster that you want by changing the
        "Keep" status to "Drop".</P>

    <P>Step 7: Click the "Confirm" button at the bottom of the page to execute these
        transactions. If there are any errors or problems you will be notified and none
        of the transactions requested will take place.</P>

    <HR>

    <P><FONT COLOR="Red"><B><?php print $ErrorMessage; ?></B></FONT></P>

    <P>You currently have <?php print $numplayers; ?> players on your roster.
        That leaves you with <?php print $MAXPLAYERS - $numplayers; ?> available slots.<BR>
        You have <?php print $ptsleft; ?> points left.</P>

    <P>Confirm that these are the players you would like to pick up</P>

    <TABLE>
        <FORM METHOD="POST" ACTION="confirm.php">
            <TR>
                <TD><B>Add</B></TD>
                <TD><B>Last Name</B></TD>
                <TD><B>First Name</B></TD>
                <TD><B>NFL Team</B></TD>
                <TD><B>Pos</B></TD>
            </TR>
            <?php $i = 0;
            $j = 0;
            //print count($wavePlayers);
            while (list($id, $last, $first, $team, $pos, $isWaive) = $pickups[$i]) {
                print "<TR><TD>";
                if ($pos != "HC") {
                    //if ($isWaiver == 1) {
                    if ($isWaive == 1) {
                        $j++;
                        //    print count($wavePlayers)+$j;
                        $displayWaiver = true;
                        print "<SELECT NAME=\"prio$id\">";
                        for ($itCnt = 1; $itCnt <= $waveCount; $itCnt++) {
                            //if ($waveCount-$i == $itCnt) {
                            if (count($wavePlayers) + $j == $itCnt) {
                                $selectFlag = " selected ";
                            } else {
                                $selectFlag = "";
                            }
                            print "<OPTION VALUE=\"$itCnt\"$selectFlag>Priority #$itCnt</OPTION>";
                        }
                    } else {
                        print "<SELECT NAME=\"pick$id\"><OPTION VALUE=\"y\">Add</OPTION>";
                    }
                    print "<OPTION VALUE=\"n\">Leave</OPTION></SELECT>";
                } else {
                    print "HC";
                }
                print "</TD><TD>$last</TD><TD>$first</TD><TD>$team</TD><TD>$pos</TD></TR>";
                $i++;
            }

            ?>

            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="5"><A HREF="list.php">Return to Player List</A></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>

            <?php //if ($isWaiver == 1) {
            if ($displayWaiver) {
//    print_r ($wavePlayers);
                ?>

                <tr>
                    <th align="center" colspan="5">WAVIER LIST</th>
                </tr>
                <TR>
                    <TD><B>Status</B></TD>
                    <TD><B>Last Name</B></TD>
                    <TD><B>First Name</B></TD>
                    <TD><B>NFL Team</B></TD>
                    <TD><B>Pos</B></TD>
                </TR>
                <?php $i = 0;
                for ($i = 0; $i < count($wavePlayers); $i++) {
//while (list($id, $last, $first, $team, $pos, $priority) = $wavePlayers[$i]) {
                    list($id, $last, $first, $team, $pos, $priority) = $wavePlayers[$i];
                    print "<tr><td>";
                    print "<select name=\"prio$id\">";
                    for ($itCnt = 1; $itCnt <= $waveCount; $itCnt++) {
                        if ($priority == $itCnt) {
                            $selectFlag = " selected ";
                        } else {
                            $selectFlag = "";
                        }
                        print "<option value=\"$itCnt\"$selectFlag>Priority #$itCnt</option>";
                    }
                    print "<option value=\"n\">Leave</option></select>";
                    if ($pos == "OL") {
                        print "<TD colspan=\"2\">$last</TD><TD>$team</TD><TD>$pos</TD></TR>";
                    } else {
                        print "<TD>$last</TD><TD>$first</TD><TD>$team</TD><TD>$pos</TD></TR>";
                    }
//	$i++;
                }
                ?>
                <tr>
                    <td>&nbsp;</td>
                </tr>
            <?php } ?>


            <TR>
                <TH ALIGN=Center COLSPAN=5>CURRENT ROSTER</TH>
            </TR>
            <TR>
                <TD><B>Status</B></TD>
                <TD><B>Last Name</B></TD>
                <TD><B>First Name</B></TD>
                <TD><B>NFL Team</B></TD>
                <TD><B>Pos</B></TD>
            </TR>
            <?php $i = 0;
            while (list($id, $last, $first, $team, $pos) = $currentroster[$i]) {
                print "<TR><TD>";
                if ($pos != "HC") {
                    print "<SELECT NAME=\"keep$id\"><OPTION VALUE=\"y\">Keep</OPTION><OPTION VALUE=\"n\">Drop</OPTION></SELECT>";
                } else {
                    print "HC";
                }
                if ($pos == "OL") {
                    print "<TD colspan=\"2\">$last</TD><TD>$team</TD><TD>$pos</TD></TR>";
                } else {
                    print "<TD>$last</TD><TD>$first</TD><TD>$team</TD><TD>$pos</TD></TR>";
                }
                $i++;
            }

            ?>

            <TR>
                <TD COLSPAN=5 ALIGN=Center><INPUT TYPE="Submit" VALUE="Confirm" NAME="submit"></TD>
            </TR>
        </FORM>
    </TABLE>

<?php } else {
    ?>

    <CENTER><B>You must be logged in to perform transactions</B></CENTER>

<?php }
include "base/footer.php";
?>
