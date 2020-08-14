<?php


namespace App\Controller\Legacy;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LegacyController extends AbstractController
{

    public function index(Request $request)
    {
//        $projDir = $this->get('http_kernel')->getProjectDir();
        $projDir = $this->getParameter('kernel.project_dir');
//        var_dump($request->attributes->get('req'));

        $path = $projDir."/legacy/src/".$request->attributes->get('req');

        return $this->render('legacy_transaction/legacy.html.twig', ['page' => $path]);
    }

    public function content($page): Response
    {
        $fullPage = $this->checkPath($page);
//        $legacyRoot = "/mnt/c/Users/Josh/IdeaProjects/wmffl-improved/legacy/src/";
//        $legacyRoot = $this->get('kernel')->getProjectDir();
        $projDir = $this->getParameter('kernel.project_dir');
        $legacyRoot = $projDir . "/legacy/src";
        set_include_path(get_include_path().":".$legacyRoot);

        if ($fullPage != null) {
            $conn = $this->getDoctrine()->getConnection();
            $currentSeason = 2020;

            ob_start();
            include $fullPage;

            $content = (string)ob_get_contents();
            ob_end_clean();
        } else {
            $content = "Content in Else: ";
            $content .= $page;
        }

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

}