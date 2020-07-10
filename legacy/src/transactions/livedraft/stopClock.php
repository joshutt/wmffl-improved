<?php require_once "utils/start.php";
require "clock.class.php";

if ($isin && $usernum==2) {
    list($round, $pick) = getCurrentPick($currentSeason);

    if (isset($_REQUEST["start"])) {
        $sql = "UPDATE config SET value='true' WHERE `key`='draft.clock.run'";
        print "Start";
        $sql2 = "UPDATE draftclockstop SET timeStarted=now() where season=$currentSeason and round=$round and pick=$pick and timeStarted is null";
    } else if (isset($_REQUEST["stop"])) {
        $sql = "UPDATE config SET value='false' WHERE `key`='draft.clock.run'";
        print "Stop";
        $sql2 = "INSERT INTO draftclockstop (season, round, pick, timeStopped) VALUES ($currentSeason, $round, $pick, now())";
    }

    $conn->query( $sql) or die("Dead: " . $conn->error);
    $conn->query( $sql2) or die("Unable to log stopped clock: " . $conn->error);

    $sql = "UPDATE config SET value='".time()."' WHERE `key`='draft.clock.start'";
    $conn->query( $sql) or die("Dead: " . $conn->error);

    if ($round==1 && $pick==1) {
        $sql = "UPDATE config SET value='".time()."' WHERE `key`='draft.full.start'";
        $conn->query( $sql) or die("Dead: " . $conn->error);
        $sql = "UPDATE config SET value='true' WHERE `key`='draft.start'";
        $conn->query( $sql) or die("Dead: " . $conn->error);
        $sql = "UPDATE draftpicks dp JOIN config c on c.`key`=concat('draft.team.',dp.teamid) JOIN config c2 on c2.`key`='draft.clock.addTime' JOIN config c3 on c3.`key`='draft.clock.maxTime' set c.value = IF(c.value + c2.value > c3.value, c3.value, c.value+c2.value) where dp.pick=1 and dp.round=1 and dp.season=$currentSeason";
        $conn->query( $sql) or die("Dead: " . $conn->error);
    }
}

?>
