<?php

use App\Kernel;
use App\LegacyBridge;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\HttpFoundation\Request;

require dirname(__DIR__) . '/vendor/autoload.php';

(new Dotenv())->bootEnv(dirname(__DIR__) . '/.env');


/*
 * Making kernel global so that it is accessible in legacy code
 */
global $kernel;

if ($_SERVER['APP_DEBUG']) {
    umask(0000);

    Debug::enable();
}

if ($trustedProxies = $_SERVER['TRUSTED_PROXIES'] ?? false) {
    Request::setTrustedProxies(explode(',', $trustedProxies), Request::HEADER_X_FORWARDED_ALL ^ Request::HEADER_X_FORWARDED_HOST);
}

if ($trustedHosts = $_SERVER['TRUSTED_HOSTS'] ?? false) {
    Request::setTrustedHosts([$trustedHosts]);
}

$kernel = new Kernel($_SERVER['APP_ENV'], (bool)$_SERVER['APP_DEBUG']);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);

//$kernel->getContainer()->get("monolog.logger");

//$log = $kernel->getContainer()->get("monolog.logger.debug");
//$log = new Logger("Index");
//$log->warning("Hello");

/*
 * TODO: LegacyBridge should do it's thing here
 */
//list($scriptFile, $locChange) = LegacyBridge::prepareLegacyScript($request, $response, __DIR__);
//if ($scriptFile !== null) {
////    $response->headers->set('Location', $scriptFile);
////    ob_start();
//    require "prepend.php";
//    require $scriptFile;
//
////    $content = (string)ob_get_contents();
////    ob_end_clean();
////    $response->setContent($content);
////    $response->send();
//} else {
    $response->send();
//}

$kernel->terminate($request, $response);
