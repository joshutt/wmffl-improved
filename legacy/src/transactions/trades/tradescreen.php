<?php
require_once "utils/start.php";

include_once "trade.class.php";
include_once "loadTrades.inc.php";
include_once "base/useful.php";
if (!$isin) {
?>
    <HTML>
    <HEAD>
    <TITLE>Trades</TITLE>
    </HEAD>

<?php  include "base/menu.php"; ?>

<H1 ALIGN=Center>Trade Screen</H1>
<HR>

<b>You must be logged in to use this feature</b>
<?php include "base/footer.html"; ?>
</BODY>
</HTML>
<?php exit;
}

$teamID = $teamnum;

$sql = "select * from offer where status='Pending' and $teamID in (TeamAID, TeamBID)";
$results = $conn->query( $sql) or die("UG");

$tradeArray = array();
$thisTeam = loadTeam($teamID);
while ($arr = $results->fetch(\Doctrine\DBAL\FetchMode::MIXED)) {
    $newTrade = loadTradeByID($arr["OfferID"], $thisTeam);
    array_push($tradeArray, $newTrade);
}


?>

<HTML>
<HEAD>
<TITLE>Trades</TITLE>
</HEAD>

<?php 
//$teamid=0;
include "base/menu.php"; ?>

<H1 ALIGN=Center>Trade Screen</H1>
<HR>

<P>Any outstanding trade offers will be listed below.  If the most recent action
on the trade is an offer by you, then you will have the option of withdrawing
the trade or amending the terms of the trade.  If the most recent action was
an offer to you, by the other team, then you have the option of accepting the
trade as is, rejecting the trade completly or making a counter offer.</P>

<P>You may make a new trade offer by selecting the team from the "Offer New 
Trade" section below.  </P>

<H3 ALIGN=Center>Pending Trade Offers</H3>

<TABLE BORDER=0 WIDTH=100%>
<!--
<TR><TH>Who With</TH>
<TH>You Would Get</TH>
<TH>They would get</TH><TH>Date Offered</TH><TH>Date Expires</TH>
<TH>Actions</TH></TR>
-->

<?php foreach($tradeArray as $trade) {
    $team = $trade->getOtherTeam();
    $teamName = $team->getName();
    if ($trade->getOfferedTeam() == $team) {
        $status = "They Made Offer, Pending Your Response";
        $buttons = array("Accept", "Reject", "Counter");
    } else {
        $status = "You Made Offer, Pending Their Response";
        $buttons = array("Withdraw", "Amend");
    }
?>
<TR BGCOLOR="#CCCCCC"><TD COLSPAN=2><B><?= $teamName;?></B></TD>
<TD COLSPAN=2><B>Offered: <?php printf("%s", date("n/j/Y", $trade->getDateOffered()));?></B></TD>
<TD COLSPAN=2><B>Expires: <?php printf("%s", date("n/j/Y", $trade->getDateExpires()));?></B></TD>
<TR><TD COLSPAN=6><B>Status: </B><?= $status;?></TD></TR>
<TR><TD COLSPAN=3 VALIGN=top>
You Would Receive:
<UL>
<?php //foreach ($playerToArray as $player) {
foreach ($trade->getPlayersTo() as $player) {
    print "<LI>".$player->getName()." (".$player->getPos()."-".$player->getNFLTeam().")";
}
//foreach ($picksToArray as $picks) {
foreach ($trade->getPicksTo() as $picks) {
    printf ("<LI>%d-%d%s Round Pick", $picks->getSeason(), $picks->getRound(), OrdinalEnding($picks->getRound()));
}
foreach ($trade->getPointsTo() as $points) {
    printf ("<LI>%d Transaction Point%s in %s", $points->getPts(), getPlural($points->getPts()), $points->getSeason());
}
?>
</UL>
</TD><TD COLSPAN=3 VALIGN=top>
They Would Receive:
<UL>
<?php //foreach ($playerFromArray as $player) {
foreach ($trade->getPlayersFrom() as $player) {
    print "<LI>".$player->getName()." (".$player->getPos()."-".$player->getNFLTeam().")";
}
//foreach ($picksFromArray as $picks) {
foreach ($trade->getPicksFrom() as $picks) {
    printf ("<LI>%d-%d%s Round Pick", $picks->getSeason(), $picks->getRound(), OrdinalEnding($picks->getRound()));
}
foreach ($trade->getPointsFrom() as $points) {
    printf ("<LI>%d Transaction Point%s in %s", $points->getPts(), getPlural($points->getPts()), $points->getSeason());
}
?>
</UL>
</TD></TR>

<FORM ACTION="processTrade.php" METHOD="POST">
<INPUT TYPE="hidden" NAME="offerid" VALUE="<?= $trade->getID();?>">
<TR>

<?php foreach ($buttons as $buttonName) {
    printf ("<TD ALIGN=\"Center\" COLSPAN=\"%d\">", 6/sizeof($buttons));
    printf ("<INPUT TYPE=\"submit\" NAME=\"action\" VALUE=\"%s\"></TD>", $buttonName);
}
?>

</FORM></TR>
<TR><TD>&nbsp;</TD></TR>
<?php }
?>
</TABLE>


<?php $sql2 = "SELECT name, teamid FROM team WHERE active=1 ORDER BY name";
$results = $conn->query( $sql2);
?>

<H3 ALIGN=Center>Offer New Trade</H3>
<FORM ACTION="edittrade.php" METHOD="POST">
Offer Trade To: <SELECT NAME="teamto">
<?php while ($teamarr = $results->fetch(\Doctrine\DBAL\FetchMode::MIXED)) {
    printf ("<OPTION VALUE=\"%d\">%s</OPTION>", $teamarr["teamid"], $teamarr["name"]);
}
?>
</SELECT>
<INPUT TYPE="Submit" VALUE="Make Offer">
</FORM>

<?php include "base/footer.html"; ?>
</BODY>
</HTML>
