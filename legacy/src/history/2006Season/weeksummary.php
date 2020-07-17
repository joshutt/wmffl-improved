<?php require_once "utils/start.php";

$thisWeek = $_REQUEST["week"];
$thisSeason = 2006;
$title = "Week $thisWeek Recap";
?>

<?php include "base/menu.php"; ?>

<style>
<!--
H4 {color:660000; text-decoration:None; font-size:14pt; font-weight:bold}

-->
</style>


<h1 align="center"><?php print $title; ?></h1>
<hr/>

<p>
    <?php
    if (file_exists("summary$thisWeek.inc")) {
        include "summary$thisWeek.inc";
    }
    ?>
</p>

<p>
<h4 class="headline">Weekly Scores</h4>
<?php include "weeklyscores.php"; ?>
</p>


<p>
<h4>Current Standings</h4>
<?php include "weekstandings.php"; ?>
</p>

<p>
<h4>Next Week's Games</h4>
<?php include "nextgame.php"; ?>
</p>

<p>
<h4>Box Scores</h4>
<?php include "boxscores.php"; ?>
</p>

<?php include "base/footer.php"; ?>
