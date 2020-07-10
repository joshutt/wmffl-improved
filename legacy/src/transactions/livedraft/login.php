<?php print "Hi";
exit();
require_once "utils/start.php";

print_r($_POST);

if (!isset($logArr)) {
    $_SESSION['logArr'] = array( 0=>0);
    $logArr = &$_SESSION['logArr'];
    
}

if (!isset($_POST)) {
    print "ERROR: Please provide username and password";
    exit();
}
print "AAA";

$commish = 0;
if (isset($team)) {
    $sql = "SELECT count(*), sum(u.commish), max(u.userid) FROM user u, team t where u.teamid=t.teamid and t.teamid=$team and u.password=MD5('$pass')";
    $resultA = $conn->query( $sql) or die("ERROR Can't verify password: " . $conn->error);
    $count = $resultA->fetch(\Doctrine\DBAL\FetchMode::NUMERIC);
    if ($count[0] == 0) {
        print "ERROR Username and password did not match";
        exit();
    }

    $commish = $count[1];
    array_push($logArr, $_REQUEST['team']);
)
    $_SESSION['userid'] = $count[2];
}

$queryArr = "(";
foreach ($logArr as $aTeam) {
    $queryArr .= "$aTeam, ";
}
$queryArr .= "100)";


if ($commish) {
    $_SESSION['commish'] = true;
    $results = $conn->query( "SELECT teamid, name FROM team where active=1") or die("ERROR Unable to get Teams in query: " . $conn->error);
} else {
    $results = $conn->query( "SELECT teamid, name FROM team where teamid in $queryArr") or die("ERROR Unable to get Teams in query: " . $conn->error);
}
while ($teamList = $results->fetch(\Doctrine\DBAL\FetchMode::MIXED)) {
    print "<option value=\"{$teamList['teamid']}\">{$teamList['name']}</option>";
}

?>
