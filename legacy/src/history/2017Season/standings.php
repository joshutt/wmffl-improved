<?php require_once "utils/start.php";

$thisWeek = $_REQUEST["week"];
if ($thisWeek == "") {
    $thisWeek = $currentWeek;
    $thisWeek = 17;
}
$thisSeason=2017;
$title = "Standings";

$clinchedList = array("Sean Taylor's Ashes" => 'z-', "Richard's Lionhearts" => 'e-', "Tim Always Pulls Out Late" => 'z-', "Woodland Rangers" => 'e-', 
                "MeggaMen" => 'e-', "Sacks on the Beach" => 'x-', "Fightin' Bitin' Beavers" => 'y-', "Fighting Squirrels" => 'e-', "Gallic Warriors" => 'e-',
                "Crusaders" => 'y-', "Amish Electricians" => 'y-', "Norsemen" => 'e-');

?>

<?php include "base/menu.php"; ?>

<style>
<!--
H4 {color:660000; text-decoration:None; font-size:14pt; font-weight:bold}

.othertitle {background:#660000 ; color:#e2a500; text-decoration:bold; font-size:14pt; text-align=center; font-family: times, courier; width: 100%;}
-->
</style>

<table width="100%">
<tr><td class="othertitle" align="center">Current Standings</td></tr></table>
<center>
<?php include "../common/weekstandings.php"; ?>

<?php if (!empty($clinchedList)) {
?>

<p>
e - eliminated from playoffs<br/>
x - clinched playoff berth<br/>
y - clinched division title<br/>
z - clinched Toilet Bowl berth
</p>
</center>
<?php } ?>

<?php include "base/footer.html"; ?>
