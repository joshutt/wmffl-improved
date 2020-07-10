<?php require_once "utils/start.php";
$thisSeason = 2003;
$thisWeek = 17;

$sql = "SELECT s.week, tn1.name, s.scorea, tn2.name, s.scoreb, w.weekname, ";
$sql .= "MONTHNAME(w.activationdue), DAYOFMONTH(w.activationdue), ";
$sql .= "DAYNAME(w.activationdue), MONTHNAME(w.enddate), DAYOFMONTH(w.enddate) ";
$sql .= ", s.label ";
$sql .= "FROM schedule s, team t1, team t2, weekmap w, teamnames tn1, teamnames tn2 ";
$sql .= "WHERE s.teama = t1.teamid ";
$sql .= "AND s.teamb = t2.teamid ";
$sql .= "AND t1.teamid=tn1.teamid AND tn1.season=s.season ";
$sql .= "AND t2.teamid=tn2.teamid AND tn2.season=s.season ";
$sql .= "AND s.season=$thisSeason ";
$sql .= "AND s.season=w.season AND s.week=w.week ";
$sql .= "ORDER BY s.week, MD5(CONCAT(tn1.name, tn2.name)) ";

$byeWeekQuery = "SELECT t.name FROM nflstatus s, nflteams t WHERE status='B' AND s.nflteam=t.nflteam AND season=$thisSeason and week=";

$title = "WMFFL Schedule";
?>

<?php include "base/menu.php"; ?>


<H1 Align=Center><?php print $thisSeason;?> Schedule</H1>

<HR size = "1"><CENTER>



<A HREF="#Week1">Week 1</A> | <A HREF="#Week2">Week 2</A> |

<A HREF="#Week3">Week 3</A> | <A HREF="#Week4">Week 4</A> |

<A HREF="#Week5">Week 5</A> | <A HREF="#Week6">Week 6</A> |

<A HREF="#Week7">Week 7</A> | <A HREF="#Week8">Week 8</A> <BR>

<A HREF="#Week9">Week 9</A> | <A HREF="#Week10">Week 10</A> |

<A HREF="#Week11">Week 11</A> | <A HREF="#Week12">Week 12</A> |

<A HREF="#Week13">Week 13</A> | <A HREF="#Week14">Week 14</A> <BR>

<A HREF="#Playoffs">Playoffs</A> |

<A HREF="#Championship">WMFFL Championship XII</A><HR size = "1"></CENTER>




<?php $results = $conn->query( $sql);

$listWeek = 0;
print "<TABLE BORDER=0>";
while ($row = $results->fetch(\Doctrine\DBAL\FetchMode::MIXED)) {
    if ($row[0] != $listWeek) {
        $byes = $conn->query( $byeWeekQuery . $row[0]);
        print "</TABLE><P>";
        print "<A NAME=\"".str_replace(" ","",$row[5])."\"><H4>".$row[5]."</H4></A>";
        print "<H5>".$row[6]." ".$row[7]."-";
        if ($row[9] != $row[6]) {
            print $row[9]." ";
        }
        print $row[10];
        if ($row[8] != "Sunday") {
            print " (".$row[8].")";
        }
        $numByes = mysqli_num_rows($byes);
        if ($numByes > 0) {
            print "<BR>NFL Byes: ";
            $byeCount = 1;
            while (list($byeTeam) = $byes->fetch(\Doctrine\DBAL\FetchMode::NUMERIC)) {
                print $byeTeam;
                if ($byeCount+1 == $numByes) {
                    print " and ";
                } else if ($byeCount < $numByes) {
                    print ", ";
                }
                $byeCount++;
            }
        }
        print "</H5>";
        print "<TABLE>";
        $listWeek = $row[0];
    }
    if ($row[4] > $row[2]) {
        $winName = $row[3];
        $winScore = $row[4];
        $loseName = $row[1];
        $loseScore = $row[2];
    } else {
        $winName = $row[1];
        $winScore = $row[2];
        $loseName = $row[3];
        $loseScore = $row[4];
    }
    print "<TR>";
    if ($row[11] != "") {
        print "<TH COLSPAN=5 ALIGN=Center>".$row[11]."</TH></TR><TR>";
    }
    if ($row[0] < $thisWeek) {
    print "<TD COLSPAN>$winName</TD><TD>$winScore</TD><TD> </TD>";
    print "<TD COLSPAN>$loseName</TD><TD>$loseScore</TD></TR>";
    } else {
    print "<TD COLSPAN>$winName</TD><TD>vs</TD>";
    print "<TD COLSPAN>$loseName</TD></TR>";
    }
}
print "</TABLE>";
?>
<!--
<A NAME="Playoffs"<H4><B>Playoffs</B></H4></A>

<H5>December 14-15</H5>

War Eagles vs Wild Card #2<BR>

Crusaders vs Wild Card #1<BR>

Toliet Bowl V: Norsemen vs Gold Division #5

<P>


<A NAME="Championship"<H4><B>WMFFL Championship XII</B></H4></A>

<H5>December 20-22 (Saturday)</H5>

Playoff Winner #1 vs Playoff Winner #2

<P>

-->


<?php include "base/footer.html"; ?>
