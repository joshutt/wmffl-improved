<?php


namespace App;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LegacyBridge
{

    public static function prepareLegacyScript(Request $request, Response $response, string $publicDirectory): ?string
    {
        // If Symfony successfully handled the route then we don't need to do anything
        if (!$response->isNotFound()) {
            return null;
        }

        global $kernel;
        $kernel->getEnvironment();


//        $basePath = $kernel->getProjectDir();
        $fileLoc = $kernel->getProjectDir() . "/legacy/src" . $request->getRequestUri();
        if (file_exists($fileLoc)) {
            return $fileLoc;
        }

        if (!str_ends_with($fileLoc, ".php") && file_exists($fileLoc.".php")) {
            return $fileLoc.".php";
        }

        return null;
        /*
         * TODO: Figure out how to map the needed script file from the existing application
         */
        $legacyScriptFile = $publicDirectory . "/info.php";
//        $logger->info("Return file ".$legacyScriptFile);

        return $legacyScriptFile;
    }

}