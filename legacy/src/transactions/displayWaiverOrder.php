<?php require_once "utils/start.php";

#if ($currentWeek == 0) {
#    $week = 1;
#} else {
    $week = $currentWeek;
#$week = 13;
#$currentSeason = 2018;
#}

$title = "Waiver Order";
?>

<?php include "base/menu.php";
?>

<h1 align="center">Waiver Wire</h1>
<hr/>

<table>
<tr><td width="45%" valign="top">
The waiver selection order for <?php print $weekName; ?>.

<?php $sql = "SELECT t.name as 'name' FROM team t, waiverorder w WHERE t.teamid=w.teamid AND w.season=$currentSeason AND w.week=$week ORDER BY w.ordernumber";
$results = $conn->query( $sql);
#print $sql;
print "<ol>";
while (list($teamSet) = $results->fetch(\Doctrine\DBAL\FetchMode::NUMERIC)) {
    print "<li>".$teamSet."</li>";
}
print "</ol>";
?>
</td><td width="10%"></td>
<td width="45%" valign="top">
<?php if ($isin) { ?>

Your current waiver priority for this week:

<?php $sql = "select p.firstname, p.lastname, p.pos, p.team from waiverpicks wp join newplayers p on wp.playerid=p.playerid where wp.season=$currentSeason and wp.week=$week and wp.teamid=$teamnum order by wp.priority";
    $results = $conn->query( $sql);
//print $sql;
print "<ol>";
    while (list($firstname, $lastName, $pos, $team) = $results->fetch(\Doctrine\DBAL\FetchMode::NUMERIC)) {
    print "<li>$firstname $lastName ($pos-$team)</li>";
}
print "</ol>";
}
?>

</td></tr>
</table>
<hr/>

<p>Last Week's waiver pickups</p>

<?php include "listwaiverpicks.php"; ?>

<?php include "base/footer.php"; ?>
