<?php
require_once "utils/start.php";

$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);
$thequery = "select teamid, password, name, userid from user where username='$username' and (password=password('$password') or password=md5('$password')) and Active='Y'";

$result = $conn->query( $thequery);
$numrow = mysqli_num_rows($result);

if ($numrow == 0) {
    $_SESSION["message"] = "Invalid Username/Password";
    $_SESSION["isin"] = False;
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    $team = $result->fetch(\Doctrine\DBAL\FetchMode::NUMERIC);
    $_SESSION["isin"] = True;
    $_SESSION["teamnum"] = $team[0];
    $_SESSION["user"] = $username;
    $_SESSION["usernum"] = $team[3];
    $_SESSION["message"] = "";
    $_SESSION["fullname"] = $team[2];

    $thequery = "update user set lastlog=now(), password=md5('$password') where username='$username'";
    #$thequery = "update user set lastlog=now() where username='$username'";
    $result = $conn->query( $thequery);
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
