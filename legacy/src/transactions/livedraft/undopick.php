<?php require_once "utils/start.php";

$season = $currentSeason;
if ($isin && $teamnum==2) {
    
    $sql = "select * from draftpicks where season = $season and playerid is not null order by Round desc, Pick desc limit 1";
    $results = $conn->query( $sql);
    $picks = $results->fetch(\Doctrine\DBAL\FetchMode::MIXED);

    $playerid = $picks['playerid'];
    $update = "update draftpicks set playerid=null where season=$season and playerid=$playerid";
    $delete = "delete from roster where dateoff is null and playerid=$playerid";

    $conn->query( $update) or die("Dead on update: " . $conn->error);
    $conn->query( $delete) or die("Dead on delete: " . $conn->error);
}

?>
