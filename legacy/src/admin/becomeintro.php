<?
require_once "base/conn.php";

$sql = "SELECT teamid, name FROM team ORDER BY name";
$results = mysqli_query($conn, $sql);
while ($teamArr = mysqli_fetch_array($results)) {
    $teamid = $teamArr["teamid"];
    $name = $teamArr["name"];
    print "<a href=\"become.php?teamchangeid=$teamid\">$name</a><br/>";
}
?>
