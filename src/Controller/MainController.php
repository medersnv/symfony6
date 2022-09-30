<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Converter;

class MainController extends AbstractController
{
    #[Route('/main', name: 'app_main')]
    public function index(Converter $converter)
    {

        $result = $converter->CovertSomToDollar(10000);

        return $this->render('main/index.html.twig', [
            'controller' => $result,
        ]);
    }

    public function test(): Response
    {

        return new Response('My first site');
//        return $this->render('main/index.html.twig', [
//            'controller_name' => 'MainController',
//        ]);
    }
}
