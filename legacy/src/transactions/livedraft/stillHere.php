<?php
require_once "utils/start.php";

$query = "REPLACE into config (`key`, `value`) VALUES ('draft.login.{$_SESSION["usernum"]}', now())";
$conn->query( $query) or die("Error on replace: " . $conn->error);

?>
