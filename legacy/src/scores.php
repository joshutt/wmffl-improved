<?php
require_once "utils/connect.php";


if ($currentWeek < 1) {
    $thisSeason = $currentSeason - 1;
    $useWeek = 16;
} else {
    $thisSeason = $currentSeason;
    $useWeek = $currentWeek;
}


$sql = "SELECT wm.weekname, wm.week, s.teama, if(s.scorea>=s.scoreb,t1.name, t2.name) as 'leadname', 
if(s.scorea>=s.scoreb,s.scorea,s.scoreb) as 'leadscore', if(s.scorea>=s.scoreb,t2.name, t1.name) as 'trailname', 
if(s.scorea>=s.scoreb,s.scoreb,s.scorea) as 'trailscore', s.label, s.overtime  
FROM weekmap wm, schedule s, team t1, team t2
where (DATE_SUB(wm.displaydate, INTERVAL 12 HOUR) < now() OR wm.week=1)
and wm.season=? and s.season=wm.season and s.week=wm.week
and s.teama=t1.teamid and s.teamb=t2.teamid
and wm.week=?
order by wm.week DESC, s.label, MD5(CONCAT(t1.name, t2.name)) ";
//limit 5";

//$results = $conn->query( $sql) or die("Dead: $sql <br/>" . $conn->error);
//$results = $conn->executeQuery($sql, array($thisSeason, $useWeek)) or die("Dead: $sql <br/>" . $conn->error);
$results = $conn->executeQuery($sql, array($thisSeason, $useWeek)) or die("Dead: $sql <br/>" . $conn->error);

?>

<div class="cat text-center"><?= strtoupper($weekName) ?> SCORES</div>
<div class="container">
    <?php

    while (list($weekname, $week, $team1, $leader, $leadscore, $trail, $trailscore, $label, $ot) = $results->fetch(\Doctrine\DBAL\FetchMode::MIXED)) {
        ?>
        <div class="gameBox border-top border-bottom row py-1">
            <?php
            if ($label != "") {
                ?>
                <div class="boxScore text-center col-12"><?= $label ?></div>

                <?php
                //break;
            }
            $otInd = $ot ? "OT" : "";
            ?>
            <div class="boxScore col-8 px-0 text-left text-truncate"><?= $leader ?><br/> <?= $trail ?></div>
            <div class="boxScore col-1 px-0 text-center"><?= $leadscore ?><br/><?= $trailscore ?>
                <span class="align-top"><?= $otInd ?></span></div>
            <div class="boxScore col-3 align-middle px-0 text-center pt-1"><a class="NFLHeadline"
                                                                              href="/activate/currentscore.php?teamid=<?= $team1 ?>&week=<?= $week ?>">Box
                    Score</a></div>

        </div>
        <?php
    }
    ?>
</div>

