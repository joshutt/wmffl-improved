<?php require_once "utils/start.php";

//print_r($_REQUEST);

if ($isin) {

$sql = <<<EOD
    INSERT INTO expansionprotections
    (teamid, playerid, type, protected)
    VALUES
EOD;

$protect = $_REQUEST['pro'];
$pullback = $_REQUEST['pb'];
$alternate = $_REQUEST['alt'];

foreach ($protect as $player) {
    $sql .= " ($teamnum, $player, 'protect', 1),";
}

foreach ($pullback as $player) {
    $sql .= " ($teamnum, $player, 'pullback', 0),";
}

foreach ($alternate as $player) {
    $sql .= " ($teamnum, $player, 'alternate', 0),";
}

$sql = trim($sql, ',');

$deleteSql = "DELETE FROM expansionprotections where teamid=$teamnum";

} 

$title = "Protections Saved";
?>

<?php include "base/menu.php"; ?>

<h1 align="center">Protections Saved</h1>
<hr/>


<?php $conn->query( $deleteSql) or die ("Unable to clear old protections: " . $conn->error);

$conn->query( $sql) or die ("Unable to save your protections: " . $conn->error);

?>


<p>Your protections have been saved.</p>

<p><a href="protectList.php">Return to Protections page</a></p>

<?php include "base/footer.php"; ?>
