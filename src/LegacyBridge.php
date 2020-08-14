<?php


namespace App;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LegacyBridge
{

    public static function prepareLegacyScript(Request $request, Response $response, string $publicDirectory): ?array
    {
        // If Symfony successfully handled the route then we don't need to do anything
        if (!$response->isNotFound()) {
            return null;
        }

        global $kernel;
        $kernel->getEnvironment();
//        $logger = $kernel->getContainer()->get('monolog.logger');


//        $basePath = $kernel->getProjectDir();
        $pathInfo = $request->getPathInfo();
        $basePath = $kernel->getProjectDir() . "/legacy/src";
        $fileLoc = $basePath . $pathInfo;
        $returnVal = self::checkPath($fileLoc);
        if ($returnVal !== null) {
            return [$returnVal, false];
        }

        // See if the url is rooted in the wrong directory
        $ref = $request->headers->get('referer');
        if ($ref !== null) {
            $relPath = $request->getRelativeUriForPath($ref);
            $host = $request->getHttpHost();
            $pos = strpos($relPath, $host);
            $fullPath = substr($relPath, $pos + strlen($host)) . $pathInfo;

            $returnVal = self::checkPath($basePath . $fullPath);
            if ($returnVal !== null) {
                $response->headers->set('Content-Location', $returnVal);
                $response->headers->set('Location', $returnVal);
                return [$returnVal, true];
            }
        }

        return null;
        /*
         * TODO: Figure out how to map the needed script file from the existing application
         */
        $legacyScriptFile = $publicDirectory . "/info.php";
//        $logger->info("Return file ".$legacyScriptFile);

        return $legacyScriptFile;
    }


    public static function checkPath($fileLoc)
    {
        if (file_exists($fileLoc)) {
            // If it's a directory go to the index file
            if (is_dir($fileLoc)) {
                return $fileLoc . "/index.php";
            }
            // Otherwise go to the file directly
            return $fileLoc;
        }

        // If file as is doesn't exist, check for .php at the end
        if (!str_ends_with($fileLoc, ".php") && file_exists($fileLoc . ".php")) {
            return $fileLoc . ".php";
        }
        return null;
    }

}