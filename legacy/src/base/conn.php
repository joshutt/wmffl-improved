<?php
require_once "utils/setup.php";

global $kernel;
$doctrine = $kernel->getContainer()->get('doctrine');

// establish Database connection information
$conn = $doctrine->getConnection();