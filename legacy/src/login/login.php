<?php
require_once "utils/start.php";

$thequery = "select teamid, password, name, userid from user where username=? and (password=password(?) or password=md5(?)) and Active='Y'";

$result = $conn->executeQuery( $thequery, array($username, $password, $password));
$teamReturn = $result->fetchAll(\Doctrine\DBAL\FetchMode::NUMERIC);

if (sizeof($teamReturn) == 0) {
    $_SESSION["message"] = "Invalid Username/Password";
    $_SESSION["isin"] = False;
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    $team = $teamReturn[0];
//    $team = $result->fetch(\Doctrine\DBAL\FetchMode::NUMERIC);
    $_SESSION["isin"] = True;
    $_SESSION["teamnum"] = $team[0];
    $_SESSION["user"] = $username;
    $_SESSION["usernum"] = $team[3];
    $_SESSION["message"] = "";
    $_SESSION["fullname"] = $team[2];

    $thequery = "update user set lastlog=now(), password=md5(?) where username=?";
    #$thequery = "update user set lastlog=now() where username='$username'";
    $result = $conn->executeQuery( $thequery, array($password, $username));
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
