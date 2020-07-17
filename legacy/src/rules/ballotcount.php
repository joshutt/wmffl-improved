<?php $PASS_THRES = .67;
$FAIL_THRES = .51;

	// Include the file that defines the connection information
// establish connection
require "base/conn.php";
require "login/loginglob.php";

if (!$isin) {
	header("Location: /ballot/ballot.php");
}


foreach ($_POST as $key => $value) {
	$thequery = "update ballot set vote='".$value."' where issueid=".$key." and teamid=".$teamnum;
    $conn->query( $thequery);

	$checkpassfail = "select sum(if(vote='Accept',1,0))/sum(if(vote<>'Abstain',1,0)) as Pass, sum(if(vote='Reject',1,0))/sum(if(vote<>'Abstain',1,0)) as Reject from ballot where issueid=".$key;
    $result = $conn->query( $checkpassfail);
    list($pass, $fail) = $result->fetch(\Doctrine\DBAL\FetchMode::NUMERIC);
	if ($pass >= $PASS_THRES) {
		// Here we email a pass message
		$body = "Proposal $key has passed";
		mail ("commish@wmffl.com", "Proposal Results", $body, "From: webmaster@wmffl.com");
	} else if ($fail >= $FAIL_THRES) {
		// Here we email a fail message
		$body = "Proposal $key has failed";
		mail ("commish@wmffl.com", "Proposal Results", $body, "From: webmaster@wmffl.com");
	}
	
	$anotherquery = "select IssueNum, IssueName from issues where issueid=".$key;
    $result = $conn->query( $anotherquery);
    list($voteNum[$key], $voteName[$key]) = $result->fetch(\Doctrine\DBAL\FetchMode::NUMERIC);
	$voteCast[$key] = $value;
	
    if ($key == 87) {
        switch ($voteCast[$key]) {
            case "Accept" : $voteCast[$key]="10 Teams"; break;
            case "Reject" : $voteCast[$key]="12 Teams"; break;
            case "Abstain" : $voteCast[$key]="No Preference"; break;
        }
    }

}
// For each key in HTTP_POST_VARS
	// key is issueid, value is result
	// print votes and save to database
	
	// check for passage or rejection if so send email
	
?>


<?php include "WMFFL Ballot" ?>
<?php include "base/menu.php"; ?>

<H1 ALIGN=Center>Votes Cast</H1>
<HR>

<P>Your casted votes were recieved.  Below is a record of how you voted.
If you would like to change you vote, you may do so at any time before the
ballot closes.  <A HREF="ballot.php">Ballot</A>.</P>

<P>
<?php foreach ($voteNum as $key => $value) {
	print $value." - ".$voteName[$key]." - ".$voteCast[$key]."<BR/>";
}
?>
</P>

<?php include "base/footer.php";?>
