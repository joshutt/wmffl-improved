<?php require_once "utils/start.php";

if (!$isin) {
    header("Location: blogentry.php");
    exit;
}

require "DataObjects/Forum.php";

$post = new DataObjects_Forum;


$subject = stripslashes(mysqli_real_escape_string($conn, $_POST["subject"]));
$body = stripslashes(mysqli_real_escape_string($conn, str_replace("\r\n", "", $_POST["body"])));


$post->settitle($subject);
$post->setbody($body);
$post->setuserid($usernum);
$post->setcreateTime(date("Y-n-d G:i:s"));
$id = $post->insert();
#print $id;

#print_r($post);

/*
#$sql = "SELECT blogaddress FROM user WHERE userid=$teamnum";
$sql = "SELECT blogaddress FROM user WHERE username='$user'";
//print $sql;
//print "<br/>";
$results = $conn->query( $sql) or die("Error in SQL: ".$conn->error);
list($address) = $results->fetch(\Doctrine\DBAL\FetchMode::NUMERIC);
//print $address;

mail($address, $subject, $body);
*/

header("Location: comments.php");
exit;
