<?php
require_once "base/conn.php";
include_once "trade.class.php";


function _array_search ($needle, $haystick) {
   foreach($haystick as $key => $val) {
       /*
       print "Compare: ";
       print_r($needle);
       print_r($val);
       print "<br/>";
       */
       if ($needle == $val) {
           //print "Return $key";
           return($key);
       }
   }
   //print "No Return";
   return(false); 
}

function loadTeam($teamID) {
    global $conn;
    $sql = "SELECT name FROM team WHERE teamid=?";
//    $stmt = $conn->prepare($sql);
//    $stmt->bindValue(1, $teamID);
    $resultlt = $conn->executeQuery($sql, [$teamID]);
    $name = $resultlt->fetch(\Doctrine\DBAL\FetchMode::MIXED);
    return new Team($name[0], $teamID);
}

function loadTradedPlayers($offerid, $teamid) {
    global $conn;
    $sql = "SELECT concat(p.firstname, ' ', p.lastname) as 'name', p.playerid, ";
    $sql .= "p.pos, p.team ";
    $sql .= "from newplayers p, offeredplayers op ";
    $sql .= "where p.playerid=op.playerid and op.offerid=$offerid ";
    $sql .= "and op.teamfromid=$teamid ";
    $sql .= "order by p.pos, p.lastname";
    $results = $conn->query( $sql) or die("Database error: $sql<br/>" . $conn->error);
    $playerArr = array();
    while ($player = $results->fetch(\Doctrine\DBAL\FetchMode::MIXED)) {
        $playerLoad = new Player($player["name"], $player["playerid"]);
        $playerLoad->setPos($player["pos"]);
        $playerLoad->setNFLTeam($player["team"]);
        array_push($playerArr, $playerLoad); 
    }
    return $playerArr;
}

function loadTradedPicks($offerid, $teamid) {
    global $conn;
    $sql = "SELECT * FROM offeredpicks ";
    $sql .= "WHERE offerid=$offerid and teamfromid=$teamid ";
    $sql .= "order by season, round";
    $results = $conn->query( $sql);

    $pickArr = array();
    while ($tradePick = $results->fetch(\Doctrine\DBAL\FetchMode::MIXED)) {
        if (isset($tradePick["OrgTeam"])) {
            $orgTeam = loadTeam($tradePick["OrgTeam"]);
        } else {
            $orgTeam = loadTeam($teamid);
        }
        $pick = new Pick($tradePick["Season"], $tradePick["Round"], $orgTeam);
        array_push($pickArr, $pick);
    }
    return $pickArr;
}

function loadTradedPoints($offerid, $teamID) {
    global $conn;
    $sql = "SELECT * FROM offeredpoints ";
    $sql .= "WHERE offerid=$offerid AND teamfromid=$teamID ";
    $sql .= "ORDER BY season";
    $results = $conn->query( $sql);

    $ptArr = array();
    while ($loadPts = $results->fetch(\Doctrine\DBAL\FetchMode::MIXED)) {
        $newPts = new Points($loadPts["Points"], $loadPts["Season"]);
        array_push($ptArr, $newPts);
    }
    return $ptArr;
}

function loadTrade(&$trade) {
    $ID = $trade->getID();
    $thisTeam = $trade->getThisTeam();
    $otherTeam = $trade->getOtherTeam();
    $thisTeamID = $thisTeam->getID();
    $otherTeamID = $otherTeam->getID();
    $trade->setPlayersTo(loadTradedPlayers($ID, $otherTeamID));
    $trade->setPlayersFrom(loadTradedPlayers($ID, $thisTeamID));
    $trade->setPicksTo(loadTradedPicks($ID, $otherTeamID));
    $trade->setPicksFrom(loadTradedPicks($ID, $thisTeamID));
    $trade->setPointsTo(loadTradedPoints($ID, $otherTeamID));
    $trade->setPointsFrom(loadTradedPoints($ID, $thisTeamID));
}

function loadTradeByID($id, $thisTeam) {
    global $conn;
    $sql = "select * from offer where offerid=$id";
    $results = $conn->query( $sql);
    $arr = $results->fetch(\Doctrine\DBAL\FetchMode::MIXED);

    $newTrade = new Trade($arr["OfferID"], $arr["Status"], $arr["Date"]);
    if ($thisTeam->getID() == $arr["TeamAID"]) {
        $newTrade->setOtherTeam(loadTeam($arr["TeamBID"]));
    } else if ($thisTeam->getID() == $arr["TeamBID"]) {
        $newTrade->setOtherTeam(loadTeam($arr["TeamAID"]));
    }
    $newTrade->setThisTeam($thisTeam);
    $newTrade->setOfferedTeam(loadTeam($arr["LastOfferID"]));
    loadTrade($newTrade);
    return $newTrade; 
}


function OrdinalEnding($count) {
    switch ($count) {
        case 1: return "st";
        case 2: return "nd";
        case 3: return "rd";
        default: return "th";
    }
}
function getPlural($count) {
    if ($count > 1) return "s";
    return "";
}


function loadRoster($team) {
    global $conn;
    $sql = "select * from newplayers p, roster r ";
    $sql .= "where p.playerid=r.playerid and r.dateoff is null ";
    $sql .= "and r.teamid=? ";
    $sql .= "order by p.pos, p.lastname";
    
    $roster = array();
    $results = $conn->executeQuery( $sql, [$team->getID()]);
    while ($arr = $results->fetch(\Doctrine\DBAL\FetchMode::MIXED)) {
        $player = new Player($arr["firstname"]." ".$arr["lastname"], $arr["playerid"]);
        $player->setPos($arr["pos"]);
        $player->setNFLTeam($arr["team"]);
        array_push($roster, $player);
    }
    return $roster;
}

function loadPlayer($playerid) {
    global $conn;
    $sql = "select * from newplayers p where playerid=$playerid";
    $results = $conn->query( $sql);
    while ($arr = $results->fetch(\Doctrine\DBAL\FetchMode::MIXED)) {
        $player = new Player($arr["firstname"]." ".$arr["lastname"], $playerid);
        $player->setPos($arr["pos"]);
        $player->setNFLTeam($arr["team"]);
    }
    return $player;
}

function saveOffer($trade) {
    global $conn;
    $ptsSQL = "INSERT INTO offeredpoints (OfferID, TeamFromID, Season, Points) ";
    $ptsSQL .= "VALUES ";
    $pickSQL = "INSERT INTO offeredpicks (OfferID, TeamFromID, Season, Round) ";
    $pickSQL .= "VALUES ";
    $playSQL = "INSERT INTO offeredplayers (OfferID, TeamFromID, PlayerID) ";
    $playSQL .= "VALUES ";
    $offerSQL = "INSERT INTO offer (TeamAID, TeamBID, Status, Date, LastOfferID) ";
    $offerSQL .= "VALUES ";
    
    // Insert Offer and get ID
    $teamA = $trade->getThisTeam();
    $teamB = $trade->getOtherTeam();
    $teamAID = $teamA->getID();
    $teamBID = $teamB->getID();
    $lastID = $trade->getID();
    if (!isset($lastID) || $lastID == 0) {
        $lastID = "NULL";
    } else {
        $oldUpdate = "UPDATE offer SET Status='Modified' WHERE OfferID=$lastID";
        $conn->query( $oldUpdate);
    }
    $offerSQL .= "($teamAID, $teamBID, 'Pending', now(), $teamAID)";
    $conn->query( $offerSQL);
    $tradeID = $conn->lastInsertId();
    $trade->setID($tradeID);

    // Insert Players
    $playersTo = $trade->getPlayersTo();
    $prevPlay = false;
    foreach ($playersTo as $player) {
        $playerID = $player->getID();
        if ($prevPlay) {
            $playSQL .= ", ";
        }
        $playSQL .= "($tradeID, $teamBID, $playerID)";
        $prevPlay = true;
    }
    $playersFrom = $trade->getPlayersFrom();
    foreach ($playersFrom as $player) {
        $playerID = $player->getID();
        if ($prevPlay) {
            $playSQL .= ", ";
        }
        $playSQL .= "($tradeID, $teamAID, $playerID)";
        $prevPlay = true;
    }

    // Insert picks
    $prevPick = false;
    $picksTo = $trade->getPicksTo();
    foreach ($picksTo as $pick) {
        if ($prevPick) {
            $pickSQL .= ", ";
        }
        $prevPick = true;
        $season = $pick->getSeason();
        $round = $pick->getRound();
        $pickSQL .= "($tradeID, $teamBID, $season, $round)";
    }
    $picksFrom = $trade->getPicksFrom();
    foreach ($picksFrom as $pick) {
        if ($prevPick) {
            $pickSQL .= ", ";
        }
        $prevPick = true;
        $season = $pick->getSeason();
        $round = $pick->getRound();
        $pickSQL .= "($tradeID, $teamAID, $season, $round)";
    }

    // Build insert pts
    $prevPts = false;
    $ptsTo = $trade->getPointsTo();
    foreach ($ptsTo as $pts) {
        if ($prevPts) {
            $ptsSQL .= ", ";
        }
        $prevPts = true;
        $season = $pts->getSeason();
        $ptsO = $pts->getPts();
        $ptsSQL .= "($tradeID, $teamBID, $season, $ptsO)";
    }
    $ptsFrom = $trade->getPointsFrom();
    foreach ($ptsFrom as $pts) {
        if ($prevPts) {
            $ptsSQL .= ", ";
        }
        $prevPts = true;
        $season = $pts->getSeason();
        $ptsO = $pts->getPts();
        $ptsSQL .= "($tradeID, $teamAID, $season, $ptsO)";
    }
   
    // Do inserts
    if ($prevPts) {
        $conn->query( $ptsSQL);
    }
    if ($prevPlay) {
        $conn->query( $playSQL);
    }
    if ($prevPick) {
        $conn->query( $pickSQL);
    }
    
}


function rejectTrade($offerid) {
    global $conn;
    $sql = "UPDATE offer SET Status='Reject' WHERE offerid=$offerid";
    $conn->query( $sql);
}

function validateTrade($offerid, $teamid) {
    global $conn;
    $mTeam = loadTeam($teamid);
    $trade = loadTradeByID($offerid, $mTeam);
    $oTeam = $trade->getOtherTeam();

    $mRoster = loadRoster($mTeam);
    $oRoster = loadRoster($oTeam);
    foreach ($trade->getPlayersTo() as $player) {
        /*
        print "<p>TRADE:";
        print_r($trade);
        print "<p>PLAYER:";
        print_r($player);
        print "<p>OROSTER:";
        print_r($oRoster);
        print "<p>ARRAY SEARCH:";
        print (_array_search($player, $oRoster));
        */
        if (!_array_search($player, $oRoster)) {
            //print "<p>return false due to Players to</p>";
            return false;
        }
    }
    foreach ($trade->getPlayersFrom() as $player) {
        if (!_array_search($player, $mRoster)) {
            //print "<p>return false due to players from</p>";
            return false;
        }
    }
    $teamID = $oTeam->getID();
    foreach ($trade->getPicksTo() as $pick) {
        $year = $pick->getSeason();
        $round = $pick->getRound();
        $orginalTeam = $pick->getOrgOwner();
        $orgTeam = $orginalTeam->getID();
        $sql = "SELECT count(*) FROM draftpicks WHERE season=$year AND round=$round ";
        $sql .= "AND teamid=$teamID AND orgTeam=$orgTeam";
        //print $sql;
        $results = $conn->query( $sql)->fetch();
        //print_r($results);
        if (count($results) != 1) {
            //print "<p>return false due to no draft picks</p>";
            return false;
        }
    }

    $teamID = $mTeam->getID();
    foreach ($trade->getPicksFrom() as $pick) {
        $year = $pick->getSeason();
        $round = $pick->getRound();
        $orginalTeam = $pick->getOrgOwner();
        $orgTeam = $orginalTeam->getID();
        $sql = "SELECT count(*) FROM draftpicks WHERE season=$year AND round=$round ";
        $sql .= "AND teamid=$teamID AND orgTeam=$orgTeam";
        $results = $conn->query( $sql)->fetch();
        if (count($results) != 1) {
            //print "<p>return false due to no draft picks from</p>";
            return false;
        }
    }
    foreach ($trade->getPointsFrom() as $pts) {
        $year = $pts->getSeason();
        $numPts = $pts->getPts();
        $sql = "SELECT ProtectionPts, TransPts, TotalPts FROM transpoints WHERE season=$year AND teamid=$teamid";
        $results = $conn->query( $sql);
        list($protPts, $tranPts, $totPts) = $results->fetch(\Doctrine\DBAL\FetchMode::NUMERIC);
        #print "$protPts + $tranPts + $numPts + $totPts<br/>";
        if ($protPts+$tranPts+$numPts > $totPts) {
            //print "<p>return false due to transactions from</p>";
            return false;
        }
    }

    return true;
}

function acceptTrade($offerid, $teamid) {
    global $conn;
    $mTeam = loadTeam($teamid);
    $trade = loadTradeByID($offerid, $mTeam);
    $oTeam = $trade->getOtherTeam();
    $otherTeam = $oTeam->getID();
    $tradeSet = array();

    // Mark offer as 'Accept'
    $acceptSQL = "UPDATE offer SET Status='Accept' WHERE offerid=$offerid";
    $conn->query( $acceptSQL);

    // For each player, remove from old roster, insert into new roster
    $playerRemoveSQL = "UPDATE roster SET Dateoff=now() WHERE Dateoff is null ";
    $playerRemoveSQL .= "AND teamid in ($otherTeam, $teamid) AND playerid in (";
    $playerInsertSQL = "INSERT INTO roster (playerid, teamid, dateon) VALUES ";
    $count = 0;
    foreach ($trade->getPlayersFrom() as $player) {
        if ($count != 0) {
            $playerRemoveSQL .= ", ";
            $playerInsertSQL .= ", ";
        }
        $playerid = $player->getID();
        $playerRemoveSQL .= $playerid;
        $playerInsertSQL .= "($playerid, $otherTeam, now())";
        $tradeSet[] = "($teamid, $otherTeam, $playerid, null";
        $count++;
    }
    foreach ($trade->getPlayersTo() as $player) {
        if ($count != 0) {
            $playerRemoveSQL .= ", ";
            $playerInsertSQL .= ", ";
        }
        $playerid = $player->getID();
        $playerRemoveSQL .= $playerid;
        $playerInsertSQL .= "($playerid, $teamid, now())";
        $tradeSet[] = "($otherTeam, $teamid, $playerid, null";
        $count++;
    }
    $playerRemoveSQL .= ")";
    if ($count > 0) {
        $conn->query( $playerRemoveSQL);
        $conn->query( $playerInsertSQL);
    }

    // For each pick, if orgTeam is null set to teamid, set teamid to new team
    $fromString = "";
    $toString = "";
    $changePickSQL = "UPDATE draftpicks SET teamid=";
    foreach ($trade->getPicksFrom() as $pick) {
        $orgOwner = $pick->getOrgOwner();
        $exChange = "$changePickSQL$otherTeam ";
        $exChange .= "WHERE Season=".$pick->getSeason()." AND Round=";
        $exChange .= $pick->getRound()." AND teamid=$teamid ";
        $exChange .= "AND orgTeam=".$orgOwner->getID();
        if ($fromString != "") {$fromString .= "and ";}
        $fromString .= "a ".$pick->getRound().ordinalEnding($pick->getRound())." round pick in ".$pick->getSeason()." ";
        $conn->query( $exChange);
    }
    foreach ($trade->getPicksTo() as $pick) {
        $orgOwner = $pick->getOrgOwner();
        $exChange = "$changePickSQL$teamid ";
        $exChange .= "WHERE Season=".$pick->getSeason()." AND Round=";
        $exChange .= $pick->getRound()." AND teamid=$otherTeam ";
        $exChange .= "AND orgTeam=".$orgOwner->getID();
        if ($toString != "") {$toString .= "and ";}
        $toString .= "a ".$pick->getRound().ordinalEnding($pick->getRound())." round pick in ".$pick->getSeason()." ";
        $conn->query( $exChange);
    }

    // For each pts, reduce and increase pts
    $addPtsSQL = "UPDATE transpoints SET TotalPts=TotalPts+";
    $subPtsSQL = "UPDATE transpoints SET TotalPts=TotalPts-";
    foreach ($trade->getPointsTo() as $pts) {
        $exChange = $addPtsSQL.$pts->getPts();
        $exChange .= " WHERE teamid=$teamid AND season=".$pts->getSeason();
        $conn->query( $exChange);
        $exChange = $subPtsSQL.$pts->getPts();
        $exChange .= " WHERE teamid=$otherTeam AND season=".$pts->getSeason();
        if ($toString != "") {$toString .= "and ";}
        $toString .= $pts->getPts()." protection points in ".$pts->getSeason()." ";
        $conn->query( $exChange);
    }
    foreach ($trade->getPointsFrom() as $pts) {
        $exChange = $addPtsSQL.$pts->getPts();
        $exChange .= " WHERE teamid=$otherTeam AND season=".$pts->getSeason();
        $conn->query( $exChange);
        $exChange = $subPtsSQL.$pts->getPts();
        $exChange .= " WHERE teamid=$teamid AND season=".$pts->getSeason();
        if ($fromString != "") {$fromString .= "and ";}
        $fromString .= $pts->getPts()." protection points in ".$pts->getSeason()." ";
        $conn->query( $exChange);
    }
    
    // Get highest trade group
    $highGroup = "SELECT max(tradegroup)+1 from trade";
    $results = $conn->query( $highGroup) or die("Database error on trade group: " . $conn->error);
    list($tradeGroup) = $results->fetch(\Doctrine\DBAL\FetchMode::NUMERIC);

    // Insert record for each item in trade
    $tradeInsert = "INSERT INTO trade (TeamFromID, TeamToID, PlayerID, Other, ";
    $tradeInsert .= "Date, TradeGroup) VALUES ";
    if ($fromString != "") {
        $tradeSet[] = "($teamid, $otherTeam, null, '$fromString'";
    }
    if ($toString != "") {
        $tradeSet[] = "($otherTeam, $teamid, null, '$toString'";
    }
    $count = 0;
    foreach ($tradeSet as $anItem) {
        if ($count != 0) {
            $tradeInsert .= ", ";
        }
        $count++;
        $tradeInsert .= "$anItem, now(), $tradeGroup) ";
    }
    $conn->query( $tradeInsert) or die ("Database error on trade insert: " . $conn->error);
    
    // Insert transactions records
    $transInsert = "INSERT INTO transactions (teamid, playerid, method, date) ";
    $transInsert .= "VALUES ($teamid, 1, 'Trade', now()), ($otherTeam, 1, 'Trade', now())";
    $conn->query( $transInsert) or die("Database error on transaction insert: " . $conn->error);
}

function printList($theyItems) {
    $output = "";
    $first = true;
    foreach ($theyItems as $obj) {
        if (!$first && $obj == $theyItems[sizeof($theyItems)-1]) {
            $output .= " and ";
        } else if ($obj != $theyItems[0]) {
            $output .=  ", ";
        }
        $first = false;
        $output .= $obj->nicePrint();
    }
    return $output;
}

