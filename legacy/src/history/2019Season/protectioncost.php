<?php require_once "utils/connect.php";
$query = "SELECT p.firstname, p.lastname, pc.years, CEILING(if(p.pos in ('QB', 'RB', 'WR', 'TE'), pc.years, pc.years/2)) as 'Extra', t.name, p.pos ";
$query .= "FROM newplayers p ";
$query .= "JOIN protectioncost pc ON p.playerid=pc.playerid ";
$query .= "LEFT JOIN roster r ON r.playerid=p.playerid AND r.dateoff is null ";
$query .= "LEFT JOIN team t on r.teamid=t.teamid ";
$query .= "WHERE pc.season=2019 ";
$query .= "GROUP BY p.playerid ";
$query .= "ORDER BY t.name, Extra desc, pc.years desc";

$base = array('HC' => 0, 'QB' => 10, 'RB' => 13, 'WR' => 12, 'TE'=>4, 'K'=>1, 'OL'=>1, 'DL'=>3, 'LB'=>5, 'DB'=>4);

$result = $conn->query( $query) or die("error: ".$conn->error);
$count = mysqli_num_rows($result);
$page = array();
while ($aLine = $result->fetch(\Doctrine\DBAL\FetchMode::MIXED)) {
    $totCost = $base[$aLine['pos']] + $aLine['Extra'];
	$page[$aLine['name']] .= "<TR><TD>".$aLine['firstname']." ".$aLine['lastname'];
    $page[$aLine['name']] .= "</TD><TD ALIGN=Center>".$aLine['pos'];
	$page[$aLine['name']] .= "</TD><TD ALIGN=Center>".$aLine['years']."</TD>";
	$page[$aLine['name']] .= "<TD ALIGN=Center>+".$aLine['Extra']."</TD>";
	$page[$aLine['name']] .= "<TD ALIGN=Center>$totCost</TD></TR>";
    $countall[$aLine['name']]++;
}

$title = "2018 Protection Costs";
?>

<?php include "base/menu.php"; ?>

<H1 Align=Center>Protection Costs</H1>
<HR size = "1">

<p>Any player not listed on the chart below will have a protection cost equal to their position's base:
<div>
<TABLE BORDER=1>
<TR><TD>QB</TD><TD>RB</TD><TD>WR</TD><TD>TE</TD><TD>K</TD><TD>OL</TD><TD>DL</TD><TD>LB</TD><TD>DB</TD></TR>
<TR><TD>10</TD><TD>13</TD><TD>12</TD><TD>4</TD><TD>1</TD><TD>1</TD><TD>3</TD><TD>5</TD><TD>4</TD></TR>
</TABLE>
</div>
</p>

<TABLE WIDTH=100%>
<TR><TD WIDTH="50%" VALIGN=Top>

<TABLE ALIGN="Center">

<?php $sumup = 0;
foreach ($page as $teamName=>$val) {
    if ($teamName == '') continue;
    if ($sumup > ($count+33)/2) {

?>
</TABLE>
</TD><TD WIDTH=*></TD><TD WIDTH=50% VALIGN=Top>

<TABLE ALIGN="Center" VALIGN=Top>
<?php         $sumup = 0;
    }
?>

<TR><TH COLSPAN=4><?php print $teamName; ?></TH></TR>
<TR><TH>Player Name</TH><TH>Pos</TH><TH>Years</TH><TH>Extra</TH><th>Total Cost</th></TR>
<?php print $val; ?>
<TR><TD>&nbsp;</TD></TR>

<?php $sumup += $countall[$teamName] + 3;
}
$teamName = '';
?>
<TR><TH COLSPAN=4>Not on a Roster</TH></TR>
<TR><TH>Player Name</TH><TH>Pos</TH><TH>Years</TH><TH>Extra</TH><th>Total Cost</th></TR>
<?php print $page['']; ?>
<TR><TD>&nbsp;</TD></TR>

</TABLE>
</TD></TR></TABLE>
<?php include "base/footer.html"; ?>
