<?php require_once "start.php";

function getTeamList($season) {
    global $conn;
    $sql = "SELECT name, teamid, abbrev FROM teamnames WHERE season=$season ORDER BY name ASC";
    $season = intval($season);
    $results = $conn->query( $sql) or die("Unable to run query: " . $conn->error);
    $teamArray = array();
    while ($row = $results->fetch(\Doctrine\DBAL\FetchMode::MIXED)) {
	$team = array("name" => $row["name"], "id" => $row["teamid"], "abbrev" => $row["abbrev"]);
        array_push($teamArray, $team);
    }
    return $teamArray;
}

function getPosList() {
    return array("HC", "QB", "RB", "WR", "TE", "K", "OL", "DL", "LB", "DB");
}
