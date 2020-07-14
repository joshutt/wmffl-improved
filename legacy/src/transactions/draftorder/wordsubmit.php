<?php require_once "utils/start.php";

$word = $_POST["word"];
$teamid = $_POST["teamid"];


if (!$isin) {
    header("Location: index.php");
    exit();
}



$query = "select `key` from config where `key` like 'draft.order.word.%' and value=''";
$results = $conn->query( $query) or die("Ugg " . $conn->error);

$query2 = "select `key`, value from config where `key` like 'draft.order.team.%' and value='$teamid'";
$result2 = $conn->query( $query2) or die("Ugg " . $conn->error);
$count = mysqli_num_rows($result2);

if ($count > 0) {
    $message2 = "You have already submitted a word.";
}

$min = 9;
while ($row = $results->fetch(\Doctrine\DBAL\FetchMode::ASSOCIATIVE)) {
    $key = $row["key"]; 
    if (substr($key, -1) < $min) {
        $min = substr($key, -1);
    }
}

if ($count == 0) {
    $query = "update config set value = '$word' where `key`='draft.order.word.$min'";
    $conn->query( $query) or die("Unable to set word " . $conn->error);
    $query = "update config set value = '$teamid' where `key`='draft.order.team.$min'";
    $conn->query( $query) or die("Unable to set team " . $conn->error);
    $message2 = "Your word has been submited as '$word' and will be the $min word in the identifier";

    if ($min == 4) {
        mail("josh@wmffl.com", "Draft Words Done", "The Draft words are done being selects");
    }
}


$title = "Word Submitted";
include "base/menu.php";
?>

<h1 align="center">Draft Order Determination</h1>
<hr size = "1" />

<p><?php print $message2; ?></p>

<p>Return to <a href="index.php">word submit</a> page</p>

<?php include "base/footer.html"; ?>
