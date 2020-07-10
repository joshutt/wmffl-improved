<?
require_once "utils/start.php";

if (!$isin) {
    header("Location: /history/2016Season/draftdate.php");
}

$numNo = 0;
foreach ($_POST as $key => $value) {
    if ($value == "N") {
        $numNo++;
    }
}

if ($numNo > 4) {

$draftMessage = <<<EOD

<font color="red"><b>Your draft request has NOT been recorded!!!</b></font></p>

<p>You may select at most 4 dates you can not attend.  If there are truly more than four dates
you can't make it, then pick the four that you are least likely to be able to attend (in person
or remotly).

EOD;

} else {
    $season = 2016;

    foreach ($_POST as $key => $value) {
        //print "$key - $value <BR>";
        $thequery = "UPDATE draftdate SET attend='$value' ";
        $thequery.= "WHERE date='$season-".substr($key,0,2)."-".substr($key,2,2)."' ";
        $thequery .= "AND userid = $usernum"; 
        
        #print $thequery."<BR>";
        mysqli_query($conn, $thequery) or die("Error: " . mysqli_error($conn));
        

    }

    $newQuery = "UPDATE draftvote SET lastUpdate=now() where season=$season and userid=$usernum";
    mysqli_query($conn, $newQuery) or die("Error: " . mysqli_error($conn));

    $draftMessage = <<<EOD
    Your draft request has been recorded.</p>

    <p>If your situation
    changes you may update your availablity at any time until the draft date is 
    announced.  After that time you will need to contact Josh.</p>
EOD;
}
    
include "draftdate.php";
?>