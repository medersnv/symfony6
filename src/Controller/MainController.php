<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/main', name: 'app_main')]
    public function index(): Response
    {
//
//        $arr = [
//            'name' => 'Meder',
//            'age' => $id
//        ];
//
//        return $this->json($arr);

        $tmp = "Symfony its cool";
        return $this->render('main/index.html.twig', [
            'key' => $tmp,
        ]);
    }

//    public function test(): Response
//    {
//
//        return new Response('My first site');
////        return $this->render('main/index.html.twig', [
////            'controller_name' => 'MainController',
////        ]);
//    }
}
