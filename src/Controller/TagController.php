<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Repository\PageRepository;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tag')]
class TagController extends AbstractController
{
    #[Route('/add', name: 'app_aad')]
    public function app_add(PageRepository $pageRepository, EntityManagerInterface $entityManager): Response
    {
        $page = $pageRepository->find(id: '1');

        $tag = new Tag();
        $tag->setTitle('Тэг 2');

        $page->addTag($tag);

        $entityManager->persist($tag);
        $entityManager->flush();

        dd('ГОТОВО');

        return $this->render('tag/index.html.twig', [
            'controller_name' => 'TagController',
        ]);
    }
}
