<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Repository\PageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/comment' )]
class CommentController extends AbstractController
{
    #[Route('/add', name: 'app_comment_add')]
    public function index(PageRepository $pageRepository, EntityManagerInterface $entityManager): Response
    {
       $page = $pageRepository->find(id: '1');

       $comment = new Comment();
       $comment->setContent('Коментарий 1');

       $page->addComment($comment);

       $entityManager->persist($comment);
       $entityManager->flush();


        dd('ГОТОВО');
    }
}
