<?php
require_once "base/conn.php";
$queryBuilder = $conn->createQueryBuilder();
$queryBuilder->select('p.firstname', 'p.lastname', 'pc.years', "max(pos.cost)-min(pos.cost) as 'Extra'", 't.name')
    ->from('players', 'p')
    ->join('p', 'protectioncost', 'pc', 'p.playerid=pc.playerid and pc.season=:season')
    ->join('p', 'positioncost', 'pos', 'p.position=pos.position and pos.years<=pc.years')
    ->leftJoin('p', 'roster', 'r', 'r.playerid=p.playerid and r.dateoff is null')
    ->leftJoin('p', 'team', 't', 'r.teamid=t.teamid')
    ->groupBy('p.playerid')
    ->addGroupBy('pos.position')
    ->orderBy('t.name')
    ->addOrderBy('Extra', 'DESC')
    ->addOrderBy('pc.years', 'DESC')
    ->setParameter('season', 2005);

$result = $queryBuilder->execute()->fetchAll(\Doctrine\DBAL\FetchMode::MIXED);

$count = count($result);
$page = array();
$countall = array();
foreach($result as $aLine) {
    if (!array_key_exists($aLine['name'], $page)) {
        $page[$aLine['name']] = '';
        $countall[$aLine['name']] = 0;
    }
    $page[$aLine['name']] .= "<TR><TD>" . $aLine['firstname'] . " " . $aLine['lastname'];
    $page[$aLine['name']] .= "</TD><TD ALIGN=Center>" . $aLine['years'] . "</TD>";
    $page[$aLine['name']] .= "<TD ALIGN=Center>+" . $aLine['Extra'] . "</TD></TR>";
    $countall[$aLine['name']]++;
}
?>

<HTML>
<HEAD>
<TITLE>2005 WMFFL Protection Costs</TITLE>
</HEAD>

<?php include "base/menu.php"; ?>

<H1 Align=Center>Protection Costs</H1>
<HR size = "1">
<P>
Protections will be based on a point system.  Every
team will be allocated 65 points with which to protect players.  Each player
will be worth a number of points based on position and years he has been
protected.  The base position points are as follows:
<TABLE BORDER=1>
<TR><TD>QB</TD><TD>RB</TD><TD>WR</TD><TD>TE</TD><TD>K</TD><TD>OL</TD><TD>DL</TD><TD>LB</TD><TD>DB</TD></TR>
<TR><TD>9</TD><TD>10</TD><TD>8</TD><TD>4</TD><TD>1</TD><TD>1</TD><TD>3</TD><TD>5</TD><TD>4</TD></TR>
</TABLE></P>

<P>The adjustment factor for years protected are:
<TABLE BORDER=1>
<TR><TH COLSPAN=9>Years Protected</TH></TR>
<TR><TD></TD><TD>1</TD><TD>2</TD><TD>3</TD><TD>4</TD><TD>5</TD><TD>6</TD><TD>7</TD><TD>8+</TD></TR>
<TR><TD>QB, RB, WR & TE</TD><TD>+1</TD><TD>+2</TD><TD>+3</TD><TD>+4</TD><TD>+4</TD><TD>+5</TD><TD>+5</TD><TD>+6</TD></TR>
<TR><TD>K, OL, DL, LB & DB</TD><TD>+1</TD><TD>+1</TD><TD>+2</TD><TD>+2</TD><TD>+3</TD><TD>+3</TD><TD>+3</TD><TD>+4</TD></TR>
</TABLE></P>

<P>Adding the postion cost and adjustment factor together will give you
a player's protection cost.  As many players as desired may be protected,
so long as a team does not exceed their point limit.  Points may be traded.
Any points not used on protections will become transaction points.  There
will be no free transaction points this year.</P>

<P>Below is a list of number of years that players have been protected.
If a player does not appear on this list, their adjustment factor will
be 0.  By taking the player's position and the number below you should
be able to find out how much each player will cost to protect.</P>

<TABLE WIDTH=100%>
<TR><TD WIDTH="50%" VALIGN=Top>

<TABLE ALIGN="Center">

<?php $sumup = 0;
foreach ($page as $teamName=>$val) {
    if ($teamName == '') continue;
    if ($sumup > ($count+33)/2) {

?>
</TABLE>
</TD><TD WIDTH=*></TD><TD WIDTH=50% VALIGN=Top>

<TABLE ALIGN=Right VALIGN=Top>
<?php         $sumup = 0;
    }
?>

<TR><TH COLSPAN=3><?php print $teamName; ?></TH></TR>
<TR><TH>Player Name</TH><TH>Years Protected</TH><TH>Extra Cost</TH></TR>
<?php print $val; ?>
<TR><TD>&nbsp;</TD></TR>

<?php $sumup += $countall[$teamName] + 3;
}
$teamName = '';
?>
<TR><TH COLSPAN=3>Not on a Roster</TH></TR>
<TR><TH>Player Name</TH><TH>Years Protected</TH><TH>Extra Cost</TH></TR>
<?php print $page['']; ?>
<TR><TD>&nbsp;</TD></TR>

</TABLE>
</TD></TR></TABLE>
<?php include "base/footer.html"; ?>
