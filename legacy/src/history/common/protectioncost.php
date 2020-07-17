<?php
require_once "utils/start.php";

$queryBuilder = $conn->createQueryBuilder();
$queryBuilder->select('p.firstname', 'p.lastname', 'pc.years', "CEILING(if(p.pos in ('QB', 'RB', 'WR', 'TE'), pc.years, pc.years/2)) as 'Extra'", 't.name', 'p.pos')
    ->from('newplayers', 'p')
    ->join('p', 'protectioncost', 'pc', 'p.playerid=pc.playerid and pc.season=:season')
    ->join('p', 'positioncost', 'pos', 'p.pos=pos.position and pos.years<=pc.years')
    ->leftJoin('p', 'roster', 'r', 'r.playerid=p.playerid and r.dateoff is null')
    ->leftJoin('p', 'team', 't', 'r.teamid=t.teamid')
    ->groupBy('p.playerid')
    ->addGroupBy('pos.position')
    ->orderBy('t.name')
    ->addOrderBy('Extra', 'DESC')
    ->addOrderBy('pc.years', 'DESC')
    ->setParameter('season', $season);

$result = $queryBuilder->execute()->fetchAll(\Doctrine\DBAL\FetchMode::MIXED);
$count = count($result);
$page = array();
$countall = array();
foreach($result as $aLine) {
    if (!array_key_exists($aLine['name'], $page)) {
        $page[$aLine['name']] = '';
        $countall[$aLine['name']] = 0;
    }
    $totCost = $base[$aLine['pos']] + $aLine['Extra'];
    $page[$aLine['name']] .= "<TR><TD>".$aLine['firstname']." ".$aLine['lastname'];
    $page[$aLine['name']] .= "</TD><TD ALIGN=Center>".$aLine['pos'];
    $page[$aLine['name']] .= "</TD><TD ALIGN=Center>".$aLine['years']."</TD>";
    $page[$aLine['name']] .= "<TD ALIGN=Center>+".$aLine['Extra']."</TD>";
    $page[$aLine['name']] .= "<TD ALIGN=Center>$totCost</TD></TR>";
    $countall[$aLine['name']]++;
}

$title = "$season Protection Costs";
?>

<?php include "base/menu.php"; ?>

<H1 Align=Center>Protection Costs</H1>
<HR size = "1">

<p>Any player not listed on the chart below will have a protection cost equal to their position's base:</p>
<div>
    <TABLE BORDER=1>
        <?php
        $posRow = "<tr>";
        $valRow = "<tr>";
        foreach ($base as $pos=>$val) {
            if ($pos === "HC") {
                continue;
            }
            $posRow .= "<td>".$pos."</td>";
            $valRow .= "<td>".$val."</td>";
        }
        $posRow .= "</tr>";
        $valRow .= "</tr>";
        ?>
        <?= $posRow ?>
        <?= $valRow ?>
    </TABLE>
</div>

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

            <TABLE ALIGN="Center" VALIGN=Top>
                <?php         $sumup = 0;
                }
                ?>

                <TR><TH COLSPAN=4><?php print $teamName; ?></TH></TR>
                <TR><TH>Player Name</TH><TH>Pos</TH><TH>Years</TH><TH>Extra</TH><th>Total Cost</th></TR>
                <?php print $val; ?>
                <TR><TD>&nbsp;</TD></TR>

                <?php $sumup += $countall[$teamName] + 3;
                }
                $teamName = '';
                ?>
                <TR><TH COLSPAN=4>Not on a Roster</TH></TR>
                <TR><TH>Player Name</TH><TH>Pos</TH><TH>Years</TH><TH>Extra</TH><th>Total Cost</th></TR>
                <?php print $page['']; ?>
                <TR><TD>&nbsp;</TD></TR>

            </TABLE>
        </TD></TR></TABLE>
<?php include "base/footer.php"; ?>
