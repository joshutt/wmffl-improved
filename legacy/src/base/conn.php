<?php
require_once "utils/setup.php";

global $kernel;
$doctrine = $kernel->getContainer()->get('doctrine');

// establish Database connection information
//$conn = mysqli_connect('localhost', $ini["userName"], $ini['password'], $ini["dbName"]);
$conn = $doctrine->getConnection();