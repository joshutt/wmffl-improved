<?php require_once "base/conn.php";

$sql = "SELECT teamid, name FROM team ORDER BY name";
$results = $conn->query( $sql);
while ($teamArr = $results->fetch(\Doctrine\DBAL\FetchMode::MIXED)) {
    $teamid = $teamArr["teamid"];
    $name = $teamArr["name"];
    print "<a href=\"become.php?teamchangeid=$teamid\">$name</a><br/>";
}
?>
