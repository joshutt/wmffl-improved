<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{

    /**
     * @Route("/")
     * @Route("/hello")
     * @return Response
     */
    public function hello(): Response
    {
        return $this->render('index.html.twig', [
            'text' => 'Hello World'
        ]);
//        return new Response("Hello World");
    }

}