<?php require_once "utils/start.php";
#require_once "base/conn.php";
#require_once "base/useful.php";

//print "**$currentSeason**<br/>";

$sql = "select wm.weekname, t.name, count(r.playerid), wm.week
from team t, roster r, weekmap wm
where t.teamid=r.teamid and (r.dateoff is null or r.dateoff>wm.activationdue) and r.dateon < wm.activationdue
and wm.season=$currentSeason and now()>=wm.startdate
and wm.week>=1
group by wm.week, t.teamid
order by `count(r.playerid)` DESC";

//print $sql;
$results = $conn->query( $sql) or die("Error: " . $conn->error);
$empty = true;
while ($teams = $results->fetch(\Doctrine\DBAL\FetchMode::MIXED)) {
    if ($teams[2] <=26) {
        break;
    }
    print $teams[0]." - ".$teams[1]." - ".$teams[2]."<br/>";
    $empty = false;
}

if ($empty) {
    print "No Teams have too many players";
}
?>


<p><a href="index.shtml">Return to Index</a></p>
