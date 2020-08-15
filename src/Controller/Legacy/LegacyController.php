<?php


namespace App\Controller\Legacy;


use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LegacyController extends AbstractController
{
    private $logger;

    // Yes this is bad, but not as bad as the legacy stuff
    private $cssMap = [
        "home" => ["/base/css/index.css"],
        "activate/currentscore" => ["score.css"],
        "activate/submitactivations" => ["/base/css/index.css"],
        "article/view" => ["/base/css/w3.css", "https://fonts.googleapis.com/icon?family=Material+Icons"],
        "forum/comments" => ["blog.css"],
        "history/recordseason" => ["/base/css/history.css"],
        "history/recordsweek" => ["/base/css/history.css"],
        "teammoney" => ["/base/css/money.css"],
        "common/draftresults" => ["/base/css/draftresults.css"],
        "draftresults" => ["/base/css/draftresults.css"],
        "common/schedule" => ["/base/css/schedule.css"],
        "schedule" => ["/base/css/schedule.css"],
        "rules/proposals" => ["rules.css"],
        "stats/leaders" => ["stats.css"],
        "stats/playerstats" => ["stats.css"],
        "stats/weekbyweek" => ["week.css", "stats.css"],
        "teams/teamheader" => ["/stats/stats.css", "/base/css/team.css"],
        "teams" => ["/stats/stats.css", "/base/css/team.css"],
    ];

    // Yes this is bad, but not as bad as the legacy stuff
    private $jsMap = [
        'home' => ["/base/js/front.js"],
        'activate/submitactivations' => ["/base/js/activations.js"],
        'stats/leaders' => ["/base/js/jquery.tablesorter.min.js", "leaders.js"],
        'stats/playerstats' => ["/base/js/jquery.tablesorter.min.js", "playerstats.js"],
        'stats/weekbyweek' => ["/base/js/jquery.tablesorter.min.js", "week.js"],
        'teams/teamheader' => ["/base/js/jquery.tablesorter.min.js", "/base/js/team.js"],
        'teams' => ["/base/js/jquery.tablesorter.min.js", "/base/js/team.js"]
    ];


    public function index(Request $request, LoggerInterface $logger)
    {
        $this->logger = $logger;

        // Determine the real path of the file being called
        $projDir = $this->getParameter('kernel.project_dir');
        $fileReq = $request->attributes->get('req');
        $path = $projDir . "/legacy/src/" . $fileReq;

        // If the file is css, js or image just load it
        if ($this->isResource($fileReq)) {
            return $this->file($path);
        }
        $logger->debug("FileReq: [".$fileReq."]");

        // Determine if extra css or js files are needed
        $params = ['page' => $path];
        $logger->debug("Check for css");
        $cssList = $this->subKeyInArray($this->cssMap, $fileReq);
        if ($cssList) {
            $logger->debug("Has a css list");
            $params['cssList'] = $cssList;
        }
        $jsList = $this->subKeyInArray($this->jsMap, $fileReq);
        if ($jsList) {
            $params['jsList'] = $jsList;
        }

        // Call the legacy render with parameters to include
        return $this->render('legacy_transaction/legacy.html.twig', $params);
    }

    public function content($page, LoggerInterface $logger): Response
    {
        $this->logger = $logger;

        // Get the real path of the file
        $fullPage = $this->checkPath($page);
        $logger->debug("Page [$page]");
        $logger->debug("Full Page [$fullPage]");
//        $legacyRoot = "/mnt/c/Users/Josh/IdeaProjects/wmffl-improved/legacy/src/";
//        $legacyRoot = $this->get('kernel')->getProjectDir();
        $projDir = $this->getParameter('kernel.project_dir');

        // Make sure the include has everything we need
        $legacyRoot = $projDir . "/legacy/src";
        set_include_path(get_include_path() . ":" . $legacyRoot);

        // If the file exist then include id
        if ($fullPage != null) {
            $conn = $this->getDoctrine()->getConnection();
            $currentSeason = 2020;

            // Capture the output of the legacy file
            ob_start();
            include $fullPage;

            $content = (string)ob_get_contents();
            ob_end_clean();
        } else {
            // The file doesn't exist
            // TODO: Do something ral here
            $content = "Content in Else: ";
            $content .= $page;
        }

        // Return the response
        return new Response($content);
    }


    /**
     * Look to see if given file exists
     * TODO: Move this to a service?
     *
     * @param $fileLoc the real file path
     * @return string|null
     */
    private function checkPath($fileLoc)
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

    /**
     * Does a string end with a given other string
     * TODO: This belongs in a StringUtil class
     *
     * @param $haystack
     * @param $needle
     * @return bool
     */
    private function endsWith($haystack, $needle)
    {
        return substr_compare($haystack, $needle, -strlen($needle)) === 0;
    }

    /**
     * Determines if the given file is an image, css or javascript file
     *
     * @param $fileReq the file to check
     * @return bool true if a css, javascript or images file, false otherwise
     */
    private function isResource($fileReq):bool
    {
        if ($this->endsWith($fileReq, "css")
            || $this->endsWith($fileReq, "gif")
            || $this->endsWith($fileReq, "jpg")
            || $this->endsWith($fileReq, "png")
            || $this->endsWith($fileReq, "js")) {
            return true;
        }
        return false;
    }

    private function subKeyInArray($array, $searchKey)
    {
        $keys = array_keys($array);
        $this->logger->debug("Search Key [$searchKey]");
        foreach ($keys as $key) {
            $this->logger->debug("Key [$key]");
            $this->logger->debug("Pos: ". strpos($key, $searchKey));
            $this->logger->debug("Pos: ". strpos($searchKey, $key));


            if (strpos($searchKey, $key) !== false) {
                $this->logger->debug("Found Match");
                return $array[$key];
            }
        }
        return false;
    }

}