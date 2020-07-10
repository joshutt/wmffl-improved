<?php
require_once "utils/start.php";

// Set every team's clock to draft.clock.allowed
$query = "update config c1 join config c2 on c2.`key`='draft.clock.allowed' set c1.value=c2.value where c1.key like 'draft.team.%'";
$conn->query( $query) or print('Error: '.$conn->error);

// Add addTime to first drafter
$query = "update draftpicks dp
join config c1 on c1.key = concat('draft.team.',dp.teamid)
join config c2 on c2.key = 'draft.clock.addTime'
set c1.value=c1.value+c2.value
where dp.season=$currentSeason and dp.round=1 and dp.pick=1";
$conn->query( $query) or print('Error: '.$conn->error);

// set the draft.clock.run to true
// set draft.start to true
$query = "update config set value='true' where `key` in ('draft.clock.run', 'draft.start')";
$conn->query( $query) or print('Error: '.$conn->error);

// set draft.clock.start to time()
// set draft.full.start to time()
$query = "update config set value=".time()." where `key` in ('draft.clock.start', 'draft.full.start')";
$conn->query( $query) or print('Error: '.$conn->error);

// Clear draft pick hold
$query = "delete from draftclockstop where Season=$currentSeason";
$conn->query( $query) or print('Error: '.$conn->error);

