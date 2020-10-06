<?php


namespace App\Controller;


use App\Services\CalculService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ServiceController extends AbstractController
{
    /**
     * @var CalculService
     */
    private $calculservice;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * ServiceController constructor.
     * @param CalculService $calculservice
     * @param Environment $twig
     */
    public function __construct(CalculService $calculservice, Environment $twig)
    {
        $this->calculservice = $calculservice;
        $this->twig = $twig;
    }

    /**
     * @Route("/calcul/{nb1}/{nb2}", name="app_service")
     */
    public function index(int $nb1, int $nb2) {
        $result = $this->calculservice->addition($nb1, $nb2);
        $content = $this->twig->render('Home/calcul.html.twig', ['result' => $result]);
        return new Response($content);
    }


}