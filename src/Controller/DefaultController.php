<?php


namespace App\Controller;

use App\Services\CalculService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;


class DefaultController
{
    /**
     * @var Environment
     */
    private $twig;




    /**
     * DefaultController constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }


    public function index()
    {
        $content = $this->twig->render('Home/index.html.twig', ['articles' => [
            [
                'titre' => 'titre1',
                'contenu1' => 'contenu1',
                'image' => 'https://picsum.photos/200',
                'etoiles' => 4,
            ],
            [
                'titre' => 'titre2',
                'contenu1' => 'contenu2',
                'image' => 'https://picsum.photos/200',
                'etoiles' => 2,
            ],
            [
                'titre' => 'titre3',
                'contenu1' => 'contenu3',
                'image' => 'https://picsum.photos/200',
                'etoiles' => 1,
            ]
        ]]);
        return new Response($content);
    }

    public function hello(string $prenom, Request $request)
    {
        $content = "Bonjour  " . $prenom . " (" . $request->getClientIp() . ") !";
        $response = new Response(json_encode([$content]));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/route-auto", name="app_route_auto")
     */
    public function helloAnnot() {
        $content = "Bonjour auto";
        return new Response($content);
    }

    /**
     * @Route("/route-auto/{prenom}", name="app_route_auto_param")
     */
    public function helloAnnotAvecParam(string $prenom) {
        $content = "Bonjour " . $prenom;
        return new Response($content);
    }

    /**
     * @Route("/route-auto/{param1}/{param2}", name="app_route_auto_param")
     */
    public function calcul(int $param1, int $param2) {
        $content = "Total =  " . ($param1 + $param2);
        return new Response($content);
    }

    /**
     * @Route("/query/{prenom}", name="app_query_param")
     */
    public function infoVisitueur(string $prenom, Request $request) {
        $content = "Bonjour  " . $prenom . " (" . $request->query->get('email') . ") !";
        $response = new Response(json_encode([$content]));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}