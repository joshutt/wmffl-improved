<?php //$currentSeason = 2004;
$checkWeek = 17;
if (array_key_exists('viewseason', $_REQUEST)) {
    $viewseason = $_REQUEST['viewseason'];
} else {
    $viewseason = $currentSeason;
    $checkWeek = $currentWeek;
}

if ($checkWeek == 0) {
    $viewseason--;
    $checkWeek = 17;
}

$otherSeason = "select distinct season from schedule where $viewteam in (teama, teamb) order by season desc";
$res1 = $conn->query( $otherSeason);
?>

<h3 class="font-weight-bold" align="center"><?php print $viewseason; ?> Schedule</h3>

<div class="col">
<?php $SQL = "SELECT if(isnull(s.label), wm.weekname, s.label) as 'weekname', t.name, 
if(s.teama=$viewteam, s.scorea, s.scoreb) as 'score', 
if(s.teamb=$viewteam, s.scorea, s.scoreb) as 'oppscore',
wm.week
FROM schedule s, teamnames t, weekmap wm
WHERE s.season=$viewseason AND ((s.teama=$viewteam and s.teamb=t.teamid) OR (s.teamb=$viewteam and s.teama=t.teamid)) 
AND s.season=wm.season AND s.week=wm.week
AND t.season=s.season
ORDER BY s.season, s.week";

//echo $SQL;
//exit();

$results = $conn->query( $SQL) or die("Unable to complete query: " . $conn->error);

print "<table align=\"center\" border=\"1\">";
while ($sched = $results->fetch(\Doctrine\DBAL\FetchMode::MIXED)) {
    if ($sched['score'] != null && $sched['week'] < $checkWeek) {
        print "<tr>";
        print "<td>${sched['weekname']}</td>";
        if ($sched['score'] > $sched['oppscore']) {
            print "<td>WIN</td>";
        } else if ($sched['score'] == $sched['oppscore']) {
            print "<td>TIE</td>";
        } else {
            print "<td>LOSS</td>";
        }
        print "<td>vs ${sched['name']}</td>";
        print "<td>${sched['score']} - ${sched['oppscore']}</td>";
        print "</tr>";
    } else {
        print "<tr>";
        print "<td>${sched['weekname']}</td>";
        print "<td></td>";
        print "<td>vs ${sched['name']}</td>";
        print "</tr>";
    }
}
?>
    </table>
</div>

<div class="pt-4 justify-content-center col text-center">
    <form action="teamschedule.php">
        <input type="hidden" name="viewteam" value="<?php print $viewteam; ?>"/>
        View previous seasons:
        <select name="viewseason" onChange="submit();">
            <option value=""></option>
            <?php             while (list($newSeason) = $res1->fetch(\Doctrine\DBAL\FetchMode::MIXED)) {
                print "<option value=\"$newSeason\">$newSeason</option>";
            }

            ?>
        </select>
    </form>
</div>

