<?php

namespace App\Controller\Legacy;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LegacyTransactionController extends AbstractController
{

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

        $content = (string) ob_get_contents();
        ob_end_clean();
        return new Response($content);
    }


    private function trade($teamid, $date) {
        global $conn;
        $tradequery="select t1.tradegroup, t1.date, tm1.name as TeamFrom, ";
        $tradequery.="p.lastname, p.firstname, p.pos, p.team, t1.other ";
        $tradequery.="from trade t1 ";
        $tradequery.="left join trade t2 on t1.tradegroup=t2.tradegroup and t1.teamfromid<>t2.teamfromid ";
        $tradequery.="join teamnames tm1 on t1.teamfromid=tm1.teamid ";
        $tradequery.="left join team tm2 on t2.teamfromid=tm2.teamid ";
        $tradequery.="join weekmap wm on tm1.season=wm.season ";
        $tradequery.="left join newplayers p on p.playerid=t1.playerid ";
        $tradequery.="where (t1.TeamFromid=$teamid or t1.TeamToid=$teamid) ";
        $tradequery.="and t1.date='$date' ";
        $tradequery.="and '$date' between wm.startDate and wm.enddate ";
        $tradequery.="group by t1.tradegroup, abs(tm1.teamid-$teamid), p.lastname ";

        $results = $conn->query( $tradequery);
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
            if (!$firstplayer) {print ", ";}
            if ($other) {print $other;}
            else print "$firstname $lastname ($position-$nflteam)";
            $firstplayer = FALSE;
        }
    }


    private function legacyContent() {
        global $conn;
        $conn = $this->getDoctrine()->getConnection();

        $theQuery = "SELECT DATE_FORMAT(max(date), '%m/%e/%Y'), DATE_FORMAT(max(date),'%m'), DATE_FORMAT(max(date),'%Y') FROM transactions";
        $results = $conn->query( $theQuery);
        list($lastUpdate, $theMonth, $theYear) = $results->fetch(\Doctrine\DBAL\FetchMode::NUMERIC);

        if (isset($_REQUEST["month"])) $theMonth = $_REQUEST["month"];
        if (isset($_REQUEST["year"])) $theYear = $_REQUEST["year"];

        ?>

        <H1 ALIGN=Center>Transactions</H1>
        <H5 ALIGN=Center>Last Updated <?= $lastUpdate;?></H5>
        <HR size = "1">

        <?php
        include "legacy/src/transactions/transmenu.php";

        // Create the query
        $theQuery="SELECT DATE_FORMAT(t.date, '%M %e, %Y'), m.name, t.method, concat(p.firstname, ' ', p.lastname), p.pos, p.team, m.teamid, DATE_FORMAT(t.date, '%Y-%m-%d') ";
        //$thequery .= "FROM transactions t, team m, players p ";
        $theQuery .= "FROM transactions t, teamnames m, newplayers p ";
        $theQuery .= "WHERE t.teamid=m.teamid AND t.playerid=p.playerid ";
        $theQuery .= "AND m.season=$theYear ";
//$thequery .= "AND t.date BETWEEN '".$_GET["year"]."-".$theMonth."-01' AND ";
        if ($theMonth > 8) {
            $theQuery .= "AND t.date BETWEEN '".$theYear."-".$theMonth."-01' AND ";
            $theQuery .= "'".$theYear."-".$theMonth."-31 23:59:59.99999' ";
        } else {
            $theQuery .= "AND t.date BETWEEN '".$theYear."-01-01' AND ";
            $theQuery .= "'".$theYear."-08-31 23:59:59.99999' ";
        }
//	$thequery .= "'".HTTP_POST_VARS["year"]."-".$_POST["month"]."-31' ";
//	$thequery .= "ORDER BY t.date DESC, m.name, t.method, p.lastname";
        $theQuery .= "ORDER BY DATE_FORMAT(t.date, '%Y/%m/%d') DESC, m.name, t.method, p.lastname";

        $results = $conn->query( $theQuery) or die("Error: " . $conn->error);
        $first = TRUE;
        $olddate = "";
        $oldteam = "";
        $oldmethod = "";
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
                switch($method) {
                    case 'Cut':  print "<LI>Dropped "; break;
                    case 'Sign': print "<LI>Picked Up "; break;
                    case 'Trade':
                        if ($tradeonce) continue 2;
                        $this->trade($teamid, $rawdate);
                        $change = TRUE;
                        $oldmethod = "";
                        $tradeonce = TRUE;
                        continue 2;
                    case 'Fire': print "<LI>Fired "; break;
                    case 'Hire': print "<LI>Hired "; break;
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
        print "</UL></UL>";
    }
}
