<?php


namespace App\Controller;


use App\Services\ArticleService;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Twig\Environment;

class ArticleController extends AbstractController
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var ArticleService
     */
    private $articleService;

    /**
     * DefaultController constructor.
     * @param Environment $twig
     * @param ArticleService $articleService
     */
    public function __construct(Environment $twig, ArticleService $articleService)
    {
        $this->twig = $twig;
        $this->articleService = $articleService;
    }

    /**
     * @Route("/route-article/{etoile}", name="app_article")
     */
    public function index(int $etoile)
    {
        $this->articleService->addArticle('toto','test', 4, '', new DateTimeImmutable('2020-10-06 10:46:39'));

        $result = $this->articleService->getEntityManager()->findOneBy(['etoiles'=>$etoile]);
        $content = $this->twig->render('Home/article.html.twig', ['result' => $result]);
        return new Response($content);
    }


}