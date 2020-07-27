<?php
// This is temporary, but maybe it's not such a bad idea
require_once "utils/start.php";
if (!isset($title)) {
    $title = "WMFFL";
}

global $kernel;
$container = $kernel->getContainer()->get('twig');
//var_dump($kernel);

// Javascript list has to exist or errors occur
if (!isset($javascriptList)) {
    $javascriptList = array();
}

// Css list has to exist or errors occur
if (!isset($cssList)) {
    $cssList = array();
}

// Render menu template
$r = $container->render('menu.html.twig', [
    'title' => $title,
    'jsList' => $javascriptList,
    'cssList' => $cssList
]);
print $r;
//include "login/logininc.php";

