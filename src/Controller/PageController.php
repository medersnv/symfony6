<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Page;
use App\Entity\Tag;
use App\Repository\PageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/page')]
class PageController extends AbstractController
{
    #[Route('/create', name: 'app_page_create')]
    public function app_page_create(EntityManagerInterface $entityManager): Response
    {
        $page = new Page();
        $page->setTitle('Пример заголовка');
        $page->setText('Пример текста');


        $comment = new Comment();
        $comment->setContent('Пробный комментарий');
        $comment->setPage($page);

        $entityManager->persist($page);
        $entityManager->persist($comment);
        $entityManager->flush();

        dd('Готово');

        return $this->render('page/index.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }

    #[Route('/all', name: 'app_page_all')]
    public function app_page_all(Request $request, PageRepository $pageRepository,
                                    PaginatorInterface $paginator): Response
    {
        $pages = $paginator->paginate($pageRepository->getAllPages(),
            $request->query->getInt('page',default: 1), 3);


        return $this->render('page/index.html.twig', [
            'pages' => $pages,
        ]);
    }

    #[Route('/{id}', name: 'app_page_get')]
    public function app_page_get(Page $page): Response
    {
//        dd($page->getComments());
//        dd($page->getTags());
//        dd($page->getComments()->isEmpty());

        return $this->render('page/page.html.twig', [
            'page' => $page,
        ]);
    }
    #[Route('show/{id}', name: 'app_page_show')]
    public function app_page_show(Page $page): Response
    {

        return $this->render('page/page.html.twig', [
            'page' => $page,
        ]);
    }

    #[Route('add-tag-to-page/{pageid}/{tagid}', name: 'addTagToPage')]
    public function addTagToPage(Page $pageid, Tag $tagid, EntityManagerInterface $em): Response
    {
        $pageid->addTag($tagid);
        $em->flush();

        return new Response(content: '<html><body>Тэг добавлен к страницу</body></html>');
    }

    #[Route('/delete', name: 'app_page_delete')]
    public function app_page_delete(PageRepository $pageRepository,
                                    EntityManagerInterface $entityManager): Response
    {
        $page = $pageRepository->find(id: '3');

        $entityManager->remove($page);
        $entityManager->flush();

        return $this->render('page/index.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }

    #[Route('/update', name: 'app_page_update')]
    public function app_page_update(PageRepository $pageRepository,
                                    EntityManagerInterface $entityManager): Response
    {
        $page = $pageRepository->find(id: '1');

        $page->setTitle('Новый заголок 2');
        $page->setText('Новый текст 2');

        $entityManager->flush();

        return $this->render('page/index.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }
}
