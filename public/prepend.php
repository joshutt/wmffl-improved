<?php
//echo "In the prepend";

global $kernel;

$legacyPath =  $kernel->getProjectDir() . "/legacy";
$legacySrc = $legacyPath . "/src";
$legacyConf = $legacyPath . "/conf";
$legacyLib = $legacyPath . "/lib";
$legacyPear = $legacyPath . "/pear";

$path = $legacyPear . PATH_SEPARATOR . $legacySrc . PATH_SEPARATOR . $legacyLib . PATH_SEPARATOR . $legacyConf;
set_include_path(get_include_path() . PATH_SEPARATOR . $path);


function query($conn, $sql) {
    if (get_class($conn) === "mysqli") {
        return $conn->query( $sql);
    }

    if (get_class($conn) === \Doctrine\DBAL\Connection::class) {
        return $conn->query($sql);
    }

}