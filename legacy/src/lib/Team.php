<?php
require_once "utils/start.php";

class Team {
    
    var $name;
    var $division;
    var $record;
    var $divRecord;
    var $ptsFor;
    var $ptsAgt;
    var $divPtsFor;
    var $divPtsAgt;
    var $games;
    var $teamid;
    var $allRef;
    var $allRefKeys;
    
    function Team($newName, $newDiv, $newID) {
        $this->name = $newName;
        $this->division = $newDiv;
        $this->teamid = $newID;
        $this->record = array(0, 0 ,0);
        $this->divRecord = array(0,0,0);
        $this->ptsFor = 0;
        $this->ptsAgt = 0;
        $this->divPtsFor = 0;
        $this->divPtsAgt = 0;
        $this->games = array();
    }

    function addGame($opp, $ptsFor, $ptsAgt, $oppDiv) {
        if ($ptsFor == "" || $ptsAgt == "") {return;}
//        print "here";
        array_push($this->games, array($opp, $ptsFor, $ptsAgt));
        if ($this->division == $oppDiv) {
            $this->divPtsFor += $ptsFor;
            $this->divPtsAgt += $ptsAgt;
            if ($ptsFor > $ptsAgt) {
                $this->divRecord[0]++;
            } elseif ($ptsFor < $ptsAgt) {
                $this->divRecord[1]++;
            } else {
                $this->divRecord[2]++;
            }
        }
        $this->ptsFor += $ptsFor;
        $this->ptsAgt += $ptsAgt;
        if ($ptsFor > $ptsAgt) {
            $this->record[0]++;
        } elseif ($ptsFor < $ptsAgt) {
            $this->record[1]++;
        } else {
            $this->record[2]++;
        }
    }

    function getWinPCT() {
        if ($this->record[0]+$this->record[2] == 0) {
            return 0.000;
        } else {
            return ($this->record[0] + $this->record[2]/2.0)/($this->record[0]+$this->record[1]+$this->record[2]);
        }
    }
    
    function getDivWinPCT() {
        if ($this->divRecord[0]+$this->divRecord[2] == 0) {
            return 0.000;
        } else {
            return ($this->divRecord[0] + $this->divRecord[2]/2.0)/($this->divRecord[0]+$this->divRecord[1]+$this->divRecord[2]);
        }
    }

    function getSOV($teamArray = NULL) {
//        return .500;
        if ($teamArray == NULL || !isset($teamArray)) {
            $teamArray = $this->allRef;
            if (empty($teamArray)) {
                return 0.000;
            }
        }
        //error_log(print_r($teamArray, true));
        $rec = array(0,0,0);
        $keyList = array_map("getTeamId", $teamArray);
        $keyList = array_flip($keyList);
        // Loop through each game and if you won, add that teams record
//        error_log(print_r($keyList, true));
//        error_log(print_r($this->games, true));
        foreach ($this->games as $game) {
//            error_log("Game: ".$game[0]);
//            error_log("Key List: ". $keyList[$game[0]]);
//            error_log("Team Array: ".$teamArray[$keyList[$game[0]]]);
//            error_log("Team Record: ".$teamArray[$keyList[$game[0]]]->record);
            $teamRec = $teamArray[$keyList[$game[0]]]->record;
            foreach ($teamArray as $team) {
                if ($team->teamid == $game[0]) {
                    $teamRec = $team->record;
                    break;
                }
            }
            if ($game[1] > $game[2]) {
                $rec[0] += $teamRec[0];
                $rec[1] += $teamRec[1];
                $rec[2] += $teamRec[2];
            } elseif ($game[1] == $game[2]) {
                $rec[0] += $teamRec[0]/2.0;
                $rec[1] += $teamRec[1]/2.0;
                $rec[2] += $teamRec[2]/2.0;
            }
        }
        $gamePlay = $rec[0]+$rec[1]+$rec[2];
        if ($gamePlay == 0) return 0.00;
        $pct = ($rec[0] + $rec[2]/2.0) / $gamePlay;
        return $pct;
    }

    function getPrintSOV($teamArray) {
        $sov = $this->getSOV($teamArray);
        return sprintf("%5.3f", $sov);
    }

    function getPrintRecord() {
        return sprintf("%s &nbsp;&nbsp;&nbsp;%5.3f", $this->printShortRecord(), $this->getWinPCT());
    }

    function printShortRecord()
    {
        if ($this->record[2] > 0) {
            return sprintf("%d - %d - %d", $this->record[0], $this->record[1], $this->record[2]);
        } else {
            return sprintf("%d - %d", $this->record[0], $this->record[1]);
        }
    }
}

function orderteam($a, $b) {
    if ($a === $b) {return 0;}
    if ($a->division < $b->division) {
        return -1;
    } elseif ($a->division > $b->division) {
        return 1;
    }
    if ($a->getWinPCT() > $b->getWinPCT()) {
        return -1;
    } elseif ($a->getWinPCT() < $b->getWinPCT()) {
        return 1;
    }
    $games = $a->games;
    /*
    print "<pre>";
    //print_r($games);
    print "</pre>";
    */
    $h2h = array(0,0,0,0,0);
    foreach ($games as $game) {
        if ($game[0] == $b->teamid) {
            $pFor = $game[1];
            $pAgt = $game[2];
            if ($pFor > $pAgt) {
                $h2h[0]++;
            } elseif ($pFor < $pAgt) {
                $h2h[1]++;
            } else {
                $h2h[2]++;
            }
            $h2h[3] += $pFor;
            $h2h[4] += $pAgt;
        }
    }
    //print $a->name."-".$b->name."-".$h2h[0]."-".$h2h[1]."<br/>";
    if ($h2h[0] > $h2h[1]) {
        return -1;
    } elseif ($h2h[0] < $h2h[1]) {
        return 1;
    }

    if ($a->division == $b->division) {
        if ($a->getDivWinPCT() > $b->getDivWinPCT()) {
            return -1;
        } elseif ($a->getDivWinPCT() < $b->getDivWinPCT()) {
            return 1;
        }
    }
    /*
    if ($a->ptsFor-$a->ptsAgt > $b->ptsFor-$b->ptsAgt) {
        return -1;
    } elseif ($a->ptsFor-$a->ptsAgt < $b->ptsFor-$b->ptsAgt) {
        return 1;
    }
    */
    /*
    */

    /*
    print "<!-- Tie ".$a->name.": ".$a->getSOV($a->games)." <br/> ".$b->name.": ".$b->getSOV($b->games)." -->";
    print "<!-- {$a->name} games: ";
    print_r($a->games);
    print "-->";
    */

//    error_log(print_r($a, TRUE));
    if ($a->getSOV() > $b->getSOV()) {
        return -1;
    } elseif ($a->getSOV() < $b->getSOV()) {
        return 1;
    }

    if ($h2h[3] > $h2h[4]) {
        return -1;
    } elseif ($h2h[3] < $h2h[4]) {
        return 1;
    }
    if ($a->name > $b->name) {
        return 1;
    } elseif ($a->name < $b->name) {
        return -1;
    }
    return 0;
}


function getTeamId($t)
{
    return $t->teamid;
}
