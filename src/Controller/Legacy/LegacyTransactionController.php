<?php

namespace App\Controller\Legacy;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LegacyTransactionController extends AbstractController
{

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @Route("/legacy/transactions", name="legacy_transaction")
     * @Route("/transactions", name="transaction")
     */
    public function __invoke(): Response
    {
        return $this->render('legacy_transaction/index.html.twig');
    }


    /**
     * @Route("/legacy/transaction_content", name="legacy_transaction_content")
     */
    public function content(): Response
    {
        ob_start();
        $this->legacyContent();

        $content = (string)ob_get_contents();
        ob_end_clean();
        return new Response($content);
    }

    private function legacyContent()
    {
        global $conn;
        $conn = $this->getDoctrine()->getConnection();

        $theQuery = "SELECT DATE_FORMAT(max(date), '%m/%e/%Y'), DATE_FORMAT(max(date),'%m'), DATE_FORMAT(max(date),'%Y') FROM transactions";
        $results = $conn->query($theQuery);
        list($lastUpdate, $theMonth, $theYear) = $results->fetch(\Doctrine\DBAL\FetchMode::NUMERIC);

        if (isset($_REQUEST["month"])) $theMonth = $_REQUEST["month"];
        if (isset($_REQUEST["year"])) $theYear = $_REQUEST["year"];

        ?>

        <H1 ALIGN=Center>Transactions</H1>
        <H5 ALIGN=Center>Last Updated <?= $lastUpdate; ?></H5>
        <HR size="1">

        <?php
        include "legacy/src/transactions/transmenu.php";

        // Create the query
        $theQuery = "SELECT DATE_FORMAT(t.date, '%M %e, %Y'), m.name, t.method, concat(p.firstname, ' ', p.lastname), p.pos, p.team, m.teamid, DATE_FORMAT(t.date, '%Y-%m-%d') ";
        //$thequery .= "FROM transactions t, team m, players p ";
        $theQuery .= "FROM transactions t, teamnames m, newplayers p ";
        $theQuery .= "WHERE t.teamid=m.teamid AND t.playerid=p.playerid ";
        $theQuery .= "AND m.season=$theYear ";
//$thequery .= "AND t.date BETWEEN '".$_GET["year"]."-".$theMonth."-01' AND ";
        if ($theMonth > 8) {
            $theQuery .= "AND t.date BETWEEN '" . $theYear . "-" . $theMonth . "-01' AND ";
            $theQuery .= "'" . $theYear . "-" . $theMonth . "-31 23:59:59.99999' ";
        } else {
            $theQuery .= "AND t.date BETWEEN '" . $theYear . "-01-01' AND ";
            $theQuery .= "'" . $theYear . "-08-31 23:59:59.99999' ";
        }
//	$thequery .= "'".HTTP_POST_VARS["year"]."-".$_POST["month"]."-31' ";
//	$thequery .= "ORDER BY t.date DESC, m.name, t.method, p.lastname";
        $theQuery .= "ORDER BY DATE_FORMAT(t.date, '%Y/%m/%d') DESC, m.name, t.method, p.lastname";

        $results = $conn->query($theQuery) or die("Error: " . $conn->error);
        $first = TRUE;
        $olddate = "";
        $oldteam = "";
        $oldmethod = "";
        ?>
        <div class="text-left">
            <?php
            while (list($date, $teamname, $method, $player, $position, $nflteam, $teamid, $rawdate) = $results->fetch(\Doctrine\DBAL\FetchMode::NUMERIC)) {
                $change = FALSE;
                if ($olddate != $date) {
                    if (!$first) {
                        print "</UL></UL>";
                    }
                    $first = FALSE;
                    print "<B><I>$date</I></B><UL>";
                    $olddate = $date;
                    $change = TRUE;
                    $firstplayer = TRUE;
                    $tradeonce = FALSE;
                }
                if ($oldteam != $teamname || $change) {
                    if (!$change) print "</UL>";
                    print "<LI><B>$teamname</B><UL>";
                    $oldteam = $teamname;
                    $change = TRUE;
                    $firstplayer = TRUE;
                    $tradeonce = FALSE;
                }
                if ($oldmethod != $method || $change) {
                    switch ($method) {
                        case 'Cut':
                            print "<LI>Dropped ";
                            break;
                        case 'Sign':
                            print "<LI>Picked Up ";
                            break;
                        case 'Trade':
                            if ($tradeonce) continue 2;
                            $this->trade($teamid, $rawdate);
                            $change = TRUE;
                            $oldmethod = "";
                            $tradeonce = TRUE;
                            continue 2;
                        case 'Fire':
                            print "<LI>Fired ";
                            break;
                        case 'Hire':
                            print "<LI>Hired ";
                            break;
                    }
//			print "<LI>$method ";
                    $oldmethod = $method;
                    $change = TRUE;
                    $firstplayer = TRUE;
                }
                if (!$firstplayer) print ", ";
                print "$player ($position-$nflteam)";
                $firstplayer = FALSE;
            }
            ?>
            </ul></ul>
        </div>
        <?php
    }

    private function trade($teamid, $date)
    {
        global $conn;
        $tradequery = "select t1.tradegroup, t1.date, tm1.name as TeamFrom, ";
        $tradequery .= "p.lastname, p.firstname, p.pos, p.team, t1.other ";
        $tradequery .= "from trade t1 ";
        $tradequery .= "left join trade t2 on t1.tradegroup=t2.tradegroup and t1.teamfromid<>t2.teamfromid ";
        $tradequery .= "join teamnames tm1 on t1.teamfromid=tm1.teamid ";
        $tradequery .= "left join team tm2 on t2.teamfromid=tm2.teamid ";
        $tradequery .= "join weekmap wm on tm1.season=wm.season ";
        $tradequery .= "left join newplayers p on p.playerid=t1.playerid ";
        $tradequery .= "where (t1.TeamFromid=$teamid or t1.TeamToid=$teamid) ";
        $tradequery .= "and t1.date='$date' ";
        $tradequery .= "and '$date' between wm.startDate and wm.enddate ";
        $tradequery .= "group by t1.tradegroup, abs(tm1.teamid-$teamid), p.lastname ";

        $results = $conn->query($tradequery);
        $oldgroup = 0;

        while (list($group, $date, $TeamFrom, $lastname, $firstname, $position, $nflteam, $other) = $results->fetch(\Doctrine\DBAL\FetchMode::NUMERIC)) {
            if ($oldgroup != $group) {
                print "<LI>Traded ";
                $oldgroup = $group;
                $firstteam = $TeamFrom;
                $firstplayer = TRUE;
            }
            if ($firstteam != $TeamFrom) {
                print " to the $TeamFrom in exchange for ";
                $firstplayer = TRUE;
                $firstteam = $TeamFrom;
            }
            if (!$firstplayer) {
                print ", ";
            }
            if ($other) {
                print $other;
            } else print "$firstname $lastname ($position-$nflteam)";
            $firstplayer = FALSE;
        }
    }

    /**
     * @Route("/legacy/transactions/list", name="legacy_transaction")
     * @Route("/transactions/list", name="legacy_transaction")
     * @return Response
     */
    public function list(Request $request): Response
    {
        $lt = $request->request->all();
        var_dump($lt);
        return $this->render('legacy_transaction/list.html.twig');
    }

    /**
     * @Route("/legacy/transaction_list_content", name="legacy_transaction_list_content")
     */
    public function listContent(Request $request): Response
    {
        ob_start();
        $this->legacyListContent($request);

        $content = (string)ob_get_contents();
        ob_end_clean();
        return new Response($content);
    }

    private function legacyListContent(Request $request)
    {
        global $conn;
        $conn = $this->getDoctrine()->getConnection();

        $onTeamQuery = "SELECT s.name as teamname, p.lastname, p.firstname, p.pos, p.team, p.playerid FROM newplayers p, roster r, team s WHERE p.playerid=r.playerid AND r.teamid=s.teamid AND r.dateoff IS NULL ";
        $neverTeamQuery = "SELECT 'Available' as teamname, p.lastname, p.firstname, p.pos, p.team, p.playerid FROM newplayers p LEFT JOIN roster r ON p.playerid = r.playerid WHERE r.dateon IS NULL ";
        $noOnTeamQuery = "SELECT 'Available' as teamname, p.lastname, p.firstname, p.pos, p.team, p.playerid FROM newplayers p, roster r WHERE p.playerid = r.playerid ";
        //$neverTeamQuery = "SELECT 'Available       ' as teamname, p.lastname, p.firstname, p.pos, p.team, p.playerid FROM newplayers p LEFT JOIN roster r ON p.playerid = r.playerid WHERE r.dateon IS NULL ";
        //$noOnTeamQuery = "SELECT 'Available       ' as teamname, p.lastname, p.firstname, p.pos, p.team, p.playerid FROM newplayers p, roster r WHERE p.playerid = r.playerid ";
        $noOnGroupQuery = "GROUP BY p.playerid HAVING COUNT(r.dateon) = COUNT(r.dateoff) ";

        $onroster = "r.dateoff is null and r.dateon is not null ";
        $offroster = "r.dateoff is not null or t.dateon is null ";
        //$whereclause = "AND p.status<>'R' AND p.status<>'O' ";
        $whereclause = "AND p.active=1 AND p.usePos=1 ";

//        var_dump($this);
        $this->logger->debug("Test");
        $lt = $request->request->all();
        var_dump($lt);
//        echo "**$lt**";

//        var_dump($request);

//        $request->

//        echo "**$Last**";
//        $this->container
//        echo "**$lt**";

        if (!isset($Position)) {
            $Position = "";
        }
        if (!isset($Team)) {
            $Team = "ANY";
        }
        if (!isset($Last)) {
            $Last = "";
        }
        if (!isset($First)) {
            $First = "";
        }
        if (!isset($Available)) {
            $Available = "";
        }
        if (!isset($Order)) {
            $Order = "";
        }
        $theset = FALSE;

        if (isset($submit)) {
            $theset = TRUE;
            // Team is first to allow retired
            if ($Team != "") {
                if ($Team == "NONE") {
                    $whereclause .= "AND (p.team='' OR p.team is null) ";
                } else if ($Team == "ANY") {
                    $whereclause .= "AND p.team<>'' AND p.team is not null ";
                } else if ($Team == "RET") {
                    // don't start with <>'R' for retired
                    //$whereclause = "AND p.status='R' ";
                    $whereclause = "AND p.retired is not null ";
                } else {
                    $whereclause .= "AND p.team='$Team' ";
                }
            }
            if ($Position != "") {
                $whereclause .= "AND p.pos='$Position' ";
            }
            if ($Last != "") {
                $whereclause .= "AND p.lastname like '%$Last%' ";
            }
            if ($First != "") {
                $whereclause .= "AND p.firstname like '%$First%' ";
            }

            if ($Available == "available") {
//			$whereclause .= "( $offroster )";
                $search = "( $neverTeamQuery $whereclause ) UNION ( $noOnTeamQuery $whereclause $noOnGroupQuery ) ";
            } else if ($Available == "taken") {
                $search = $onTeamQuery . $whereclause;
//			$whereclause .= $onroster;
            } else {
                //$search = "( $neverTeamQuery $whereclause ) UNION ( $noOnTeamQuery $whereclause $noOnGroupQuery ) UNION ( $onTeamQuery $whereclause ) ";
                $search = "($neverTeamQuery $whereclause ) UNION  ($noOnTeamQuery $whereclause $noOnGroupQuery)  UNION  ($onTeamQuery $whereclause)  ";
//			$whereclause .= "1=1 ";
            }


            if ($Order == "") $Order = "lastname";
            $orderby = "ORDER BY " . $Order;

            //$result = $conn->query( "$search where $whereclause $orderby") or die("query");
            //print $search.$orderby;
            $result = $conn->query($search . $orderby) or die("query: $search$orderby<br/>" . $conn->error);


        }
        ?>


        <H1 ALIGN=Center>List Players</H1>
        <HR size="1">

        <?php
        if ($this->getUser()) {
            ?>

            <P>Step 1: Search for players by any of the below criteria and selecting "List Players".
                First and Last Name have assumed wildcards (ie, 'Sm' will give you Smith and Small
                as well as Ismail and Riemersma).</P>

            <P>Step 2: Change the 'Available' tag to 'Pick Up' for any players you are interested in. If you only want
                to drop players or change your waiver priorities skip this step.</P>

            <P>Step 3: Click the "Perform Transactions" button to go to the next page.</P>
            <HR>

            <FORM ACTION="list" METHOD="POST">

                Last Name:<INPUT TYPE="text" NAME="Last" VALUE="<?php print $Last; ?>">
                First Name:<INPUT TYPE="text" NAME="First" VALUE="<?php print $First; ?>"><BR>

                <SELECT NAME="Position">
                    <OPTION VALUE=""<?php if ($Position == "") print " SELECTED "; ?>>ALL Positions</OPTION>
                    <OPTION VALUE="HC"<?php if ($Position == "HC") print " SELECTED "; ?>>Head Coaches</OPTION>
                    <OPTION VALUE="QB"<?php if ($Position == "QB") print " SELECTED "; ?>>Quarterbacks</OPTION>
                    <OPTION VALUE="RB"<?php if ($Position == "RB") print " SELECTED "; ?>>Runningbacks</OPTION>
                    <OPTION VALUE="WR"<?php if ($Position == "WR") print " SELECTED "; ?>>Wide Recievers</OPTION>
                    <OPTION VALUE="TE"<?php if ($Position == "TE") print " SELECTED "; ?>>Tight Ends</OPTION>
                    <OPTION VALUE="K"<?php if ($Position == "K") print " SELECTED "; ?>>Kickers</OPTION>
                    <OPTION VALUE="OL"<?php if ($Position == "OL") print " SELECTED "; ?>>Offensive Lines</OPTION>
                    <OPTION VALUE="DL"<?php if ($Position == "DL") print " SELECTED "; ?>>Defensive Lines</OPTION>
                    <OPTION VALUE="LB"<?php if ($Position == "LB") print " SELECTED "; ?>>Linebackers</OPTION>
                    <OPTION VALUE="DB"<?php if ($Position == "DB") print " SELECTED "; ?>>Defensive Backs</OPTION>
                </SELECT>

                <SELECT NAME="Team">
                    <OPTION VALUE=""<?php if ($Team == "") print " SELECTED "; ?>>ALL NFL Teams</OPTION>
                    <OPTION VALUE="ANY"<?php if ($Team == "ANY") print " SELECTED "; ?>>Any</OPTION>
                    <OPTION VALUE="NONE"<?php if ($Team == "NONE") print " SELECTED "; ?>>None</OPTION>
                    <OPTION VALUE="RET"<?php if ($Team == "RET") print " SELECTED "; ?>>Retired</OPTION>
                    <OPTION VALUE="ARI"<?php if ($Team == "ARI") print " SELECTED "; ?>>Arizona</OPTION>
                    <OPTION VALUE="ATL"<?php if ($Team == "ATL") print " SELECTED "; ?>>Atlanta</OPTION>
                    <OPTION VALUE="BAL"<?php if ($Team == "BAL") print " SELECTED "; ?>>Baltimore</OPTION>
                    <OPTION VALUE="BUF"<?php if ($Team == "BUF") print " SELECTED "; ?>>Buffalo</OPTION>
                    <OPTION VALUE="CAR"<?php if ($Team == "CAR") print " SELECTED "; ?>>Carolina</OPTION>
                    <OPTION VALUE="CHI"<?php if ($Team == "CHI") print " SELECTED "; ?>>Chicago</OPTION>
                    <OPTION VALUE="CIN"<?php if ($Team == "CIN") print " SELECTED "; ?>>Cincinnati</OPTION>
                    <OPTION VALUE="CLE"<?php if ($Team == "CLE") print " SELECTED "; ?>>Cleveland</OPTION>
                    <OPTION VALUE="DAL"<?php if ($Team == "DAL") print " SELECTED "; ?>>Cowgirls</OPTION>
                    <OPTION VALUE="DEN"<?php if ($Team == "DEN") print " SELECTED "; ?>>Denver</OPTION>
                    <OPTION VALUE="DET"<?php if ($Team == "DET") print " SELECTED "; ?>>Detroit</OPTION>
                    <OPTION VALUE="GB"<?php if ($Team == "GB") print " SELECTED "; ?>>Green Bay</OPTION>
                    <OPTION VALUE="IND"<?php if ($Team == "IND") print " SELECTED "; ?>>Indianapolis</OPTION>
                    <OPTION VALUE="HOU"<?php if ($Team == "HOU") print " SELECTED "; ?>>Houston</OPTION>
                    <OPTION VALUE="JAC"<?php if ($Team == "JAC") print " SELECTED "; ?>>Jacksonville</OPTION>
                    <OPTION VALUE="KC"<?php if ($Team == "KC") print " SELECTED "; ?>>Kansas City</OPTION>
                    <OPTION VALUE="LV"<?php if ($Team == "LV") print " SELECTED "; ?>>Las Vegas</OPTION>
                    <OPTION VALUE="LAC"<?php if ($Team == "LAC") print " SELECTED "; ?>>LA Chargers</OPTION>
                    <OPTION VALUE="LAR"<?php if ($Team == "LAR") print " SELECTED "; ?>>LA Rams</OPTION>
                    <OPTION VALUE="MIA"<?php if ($Team == "MIA") print " SELECTED "; ?>>Miami</OPTION>
                    <OPTION VALUE="MIN"<?php if ($Team == "MIN") print " SELECTED "; ?>>Minnesota</OPTION>
                    <OPTION VALUE="NE"<?php if ($Team == "NE") print " SELECTED "; ?>>New England</OPTION>
                    <OPTION VALUE="NO"<?php if ($Team == "NO") print " SELECTED "; ?>>New Orleans</OPTION>
                    <OPTION VALUE="NYG"<?php if ($Team == "NYG") print " SELECTED "; ?>>New York Giants</OPTION>
                    <OPTION VALUE="NYJ"<?php if ($Team == "NYJ") print " SELECTED "; ?>>New York Jets</OPTION>
                    <OPTION VALUE="PHI"<?php if ($Team == "PHI") print " SELECTED "; ?>>Philadelphia</OPTION>
                    <OPTION VALUE="PIT"<?php if ($Team == "PIT") print " SELECTED "; ?>>Pittsburgh</OPTION>
                    <OPTION VALUE="SEA"<?php if ($Team == "SEA") print " SELECTED "; ?>>Seattle</OPTION>
                    <OPTION VALUE="SF"<?php if ($Team == "SF") print " SELECTED "; ?>>San Francisco</OPTION>
                    <OPTION VALUE="TB"<?php if ($Team == "TB") print " SELECTED "; ?>>Tampa Bay</OPTION>
                    <OPTION VALUE="TEN"<?php if ($Team == "TEN") print " SELECTED "; ?>>Tennessee</OPTION>
                    <OPTION VALUE="WAS"<?php if ($Team == "WAS") print " SELECTED "; ?>>Washington</OPTION>
                </SELECT>

                <SELECT NAME="Available">
                    <OPTION VALUE="" <?php if ($Available == "") print "SELECTED "; ?>>ALL Players</OPTION>
                    <OPTION VALUE="available" <?php if ($Available == "available") print "SELECTED "; ?>>Available
                        Players
                    </OPTION>
                    <OPTION VALUE="taken" <?php if ($Available == "taken") print "SELECTED "; ?>>Taken Players</OPTION>
                </SELECT>

                <INPUT TYPE="Hidden" NAME="Order" VALUE="<?php print $Order; ?>">
                <INPUT TYPE="Submit" NAME="submit" VALUE="List Players">
            </FORM>

            <TABLE>
                <FORM ACTION="confirm.php" METHOD="POST">
                    <TR>
                        <TD>
                            <B><A HREF="list.php?Position=<?php print $Position; ?>&Team=<?php print $Team; ?>&Available=<?php print $Available; ?>&Order=teamname&submit=y&Last=<?php print $Last; ?>&First=<?php print $First; ?>">Current
                                    Team</A></B></TD>
                        <TD>&nbsp;&nbsp;&nbsp;</TD>
                        <TD>
                            <B><A HREF="list.php?Position=<?php print $Position; ?>&Team=<?php print $Team; ?>&Available=<?php print $Available; ?>&Order=lastname&submit=y&Last=<?php print $Last; ?>&First=<?php print $First; ?>">Last
                                    Name</A></B></TD>
                        <TD>&nbsp;&nbsp;&nbsp;</TD>
                        <TD>
                            <B><A HREF="list.php?Position=<?php print $Position; ?>&Team=<?php print $Team; ?>&Available=<?php print $Available; ?>&Order=firstname&submit=y&Last=<?php print $Last; ?>&First=<?php print $First; ?>">First
                                    Name</A></B></TD>
                        <TD>&nbsp;&nbsp;&nbsp;</TD>
                        <TD>
                            <B><A HREF="list.php?Position=<?php print $Position; ?>&Team=<?php print $Team; ?>&Available=<?php print $Available; ?>&Order=position&submit=y&Last=<?php print $Last; ?>&First=<?php print $First; ?>">Pos</A></B>
                        </TD>
                        <TD>&nbsp;&nbsp;&nbsp;</TD>
                        <TD>
                            <B><A HREF="list.php?Position=<?php print $Position; ?>&Team=<?php print $Team; ?>&Available=<?php print $Available; ?>&Order=nflteam&submit=y&Last=<?php print $Last; ?>&First=<?php print $First; ?>">NFL
                                    Team</A></B></TD>
                    </TR>
                    <?php if ($theset) {
                        while (list($avail, $last, $first, $pos, $team, $id) = $result->fetch(\Doctrine\DBAL\FetchMode::NUMERIC)) {
                            if ($avail == "Available") {
                                print "<TR><TD><SELECT NAME=\"pick$id\"><OPTION VALUE=\"\" SELECTED>Available</OPTION><OPTION VALUE=\"$id\">Pick Up</OPTION></SELECT></TD>";
                            } else {
                                print "<TR><TD>$avail</TD>";
                            }
                            print "<TD>&nbsp;&nbsp;&nbsp;</TD><TD>$last</TD><TD>&nbsp;&nbsp;&nbsp;</TD><TD>$first</TD><TD>&nbsp;&nbsp;&nbsp;</TD><TD>$pos</TD><TD>&nbsp;&nbsp;&nbsp;</TD><TD>$team</TD></TR>";
                        }
                    }

                    ?>
                    <TR>
                        <TD COLSPAN=9 ALIGN=Center><INPUT TYPE="Submit" NAME="submit" VALUE="Perform Transactions"></TD>
                    </TR>
                </FORM>
            </TABLE>

        <?php } else {
            ?>

            <CENTER><B>You must be logged in to perform transactions</B></CENTER>

        <?php }
    }
}
