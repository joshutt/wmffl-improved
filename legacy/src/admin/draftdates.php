<?php require_once "base/conn.php";

$nflStartDate = '2019-09-05';
$season=2019;

$query = "SELECT t.name, d.date, min( d.attend ) as attend
FROM  `draftdate` d, user u, team t
WHERE u.userid = d.userid AND u.teamid=t.teamid AND d.date >  '$season-01-01' 
GROUP  BY u.teamid, d.date
ORDER BY d.date";

$results = $conn->query( $query);
$date = "";
$dateList = array();

while ($arrayList = $results->fetch(\Doctrine\DBAL\FetchMode::MIXED)) {
    if ($date != $arrayList["date"]) {
        $date = $arrayList["date"];
        $dateArray = array();
        $dateArray["yes"] = 0;
        $dateArray["no"] = 0;
    }

    if ($arrayList["attend"] == "Y") {
        $dateArray["yes"]++;
    } else {
        $dateArray["no"]++;
    }
    $dateList[$date] = $dateArray;
}


$max = 0;
$maxArray = array();
foreach ($dateList as $date => $dateArray) {
    if ($dateArray["yes"] > $max) {
        $max = $dateArray["yes"];
        $maxArray=array($date);
    } else if ($dateArray["yes"] == $max) {
        array_push($maxArray, $date);
    }
}


$secondQuery = <<<EOD
select tn.name, max(lastUpdate)
from owners o
join draftvote dv on o.userid=dv.userid and dv.season=o.season
join teamnames tn on tn.season=o.season and tn.teamid=o.teamid
where o.season=$season
group by o.teamid
having max(dv.lastUpdate) is null
EOD;

$results = $conn->query( $secondQuery) or die("Error: " . $conn->error);

$teamArray = array();
while ($arrayList = $results->fetch(\Doctrine\DBAL\FetchMode::MIXED)) {
    array_push($teamArray, $arrayList["name"]);
}

/* The Display */
print "<table border=\"1\">";
print "<tr><th>Date</th><th>Yes</th><th>No</th></tr>";
foreach($dateList as $date => $dateArray) {
    if ($dateArray["yes"] == $max) {
        print "<tr><td><b>$date</b></td><td><b>{$dateArray["yes"]}</b></td><td><b>{$dateArray["no"]}</b></td></tr>";
    } else {
        print "<tr><td>$date</td><td>{$dateArray["yes"]}</td><td>{$dateArray["no"]}</td></tr>";
    }
}
print "</table>";


print "<p>The max is $max</p>";

if (sizeof($teamArray)) {
    print "<p>Teams not voting</p>";
    foreach ($teamArray as $name) {
        print "$name<br/>";
    }

} else {
    print "<p>All teams have voted</p>";
}

?>

