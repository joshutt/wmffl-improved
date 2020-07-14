<?php
require_once "utils/connect.php";

if (array_key_exists('viewteam', $_REQUEST)) {
    $viewteam = $_REQUEST['viewteam'];
} else {
    $viewteam = 2;
}
//$viewteam = $conn->real_escape_string($viewteam);

$teaminfoSQL = "SELECT t.name as 'teamname', t.member, u.name,
t.logo, t.fulllogo, t.motto, t.teamid, min(o.season) as 'season'
FROM team t LEFT JOIN user u
ON t.teamid=u.teamid
AND u.active='Y'
LEFT JOIN owners o on t.teamid=o.teamid and u.userid=o.userid
WHERE REPLACE(LOWER(?), ' ', '') IN (LOWER(t.teamid), LOWER(t.abbrev), replace(LOWER(t.name),' ',''))
ORDER BY u.primaryowner DESC, u.name
";

//print $teaminfoSQL;
//exit(1);
$results = $conn->executeQuery($teaminfoSQL, [$viewteam]) or die("Error in query: ".$conn->error);
//$results = $conn->query($teaminfoSQL) or die("Error in query: " . $conn->error);

$ownerList = null;
$ownCount = 1;
$teamname = "";
while ($teaminfo = $results->fetch(\Doctrine\DBAL\FetchMode::MIXED)) {
    $teamname = $teaminfo['teamname'];
    if ($ownerList != null) {
        $ownerList .= " and ";
        $ownCount++;
    }
    $viewteam = $teaminfo['teamid'];
    $ownerList .= $teaminfo['name'];
    $teamsince = $teaminfo['member'];
    $ownerSince = $teaminfo['season'];
    $teammotto = "";
    if ($teaminfo['motto'] != null) {
        $teammotto = "\"${teaminfo['motto']}\"";
    }
//    $fulllogo = $teaminfo['fulllogo'];
    $logo = $teaminfo['logo'];
}
$title = "$teamname $page";
if ($ownCount > 1) {
    $ownername = "Owners: $ownerList";
} else {
    $ownername = "Owner: $ownerList";
}

$titleSQL = "SELECT season FROM titles WHERE teamid=$viewteam AND type='League'";
$results = $conn->query( $titleSQL) or die("Error: " . $conn->error);
$champyear = array();
while (list($newSeason) = $results->fetch(\Doctrine\DBAL\FetchMode::MIXED)) {
    array_push($champyear, $newSeason);
}

$cssList = array("/stats/stats.css", "/base/css/team.css");
$javascriptList = array("//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js", "/base/js/jquery.tablesorter.min.js", "/base/js/team.js");
include "base/menu.php";
?>

<?php if (isset($fulllogo) && $fulllogo == 1) {
?>

    <center><img src="/teams/<?= $logo; ?>" align="center" alt="<?= $teamname; ?>"/>
        <div class="h5 justify-content-center"><?= $ownername; ?><BR>Member Since <?= $teamsince; ?><BR>
            <I><?= $teammotto; ?></I></div>
</center>

<?php } else { ?>

<div id="wrapper">
<div id="teamLogoBlock">
<?php if ($logo != null) { ?>
    <div id="logo-left"><img src="/teams/<?= $logo; ?>" alt="<?= $teamname; ?>"/></div>
<?php } ?>
<div id="team-name">
    <span id="big-name"><?= $teamname; ?></span>
    <span id="est">Established <?= $teamsince; ?></span>
    <span id="ownName"><?= $ownername; ?><BR>Since <?= $ownerSince; ?></span>
</div>
<?php if ($logo != null) { ?>
    <div id="logo-right"><img src="/teams/<?= $logo; ?>" alt="<?= $teamname; ?>"/></div>
<?php } ?>
</div></div>
    <?php
}

//$champyear = array (2004);
include "newlinkbar.php";
?>

