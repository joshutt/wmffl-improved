<?php require_once "utils/start.php";

$sql = "SELECT MAX(messageId) FROM chat ";
$results = $conn->query( $sql) or die("Die: " + $conn->error);
list($message) = $results->fetch(\Doctrine\DBAL\FetchMode::NUMERIC);

print $message;
?>
