<?php


namespace App\Services;


use App\Entity\Articles;
use DateTimeInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class ArticleService
{
    private $entityManager;
    private $logger;

    /**
     * ArticleService constructor.
     * @param $em
     * @param $logger
     */
    public function __construct(EntityManagerInterface $em, LoggerInterface $logger)
    {
        $this->entityManager = $em;
        $this->logger = $logger;
    }

    public function addArticle(string $titre, string $content, int $etoile,string $image, DateTimeInterface $creation_date){
        $article = new Articles();
        $article->setTitre($titre);
        $article->setContent($content);
        $article->setEtoiles($etoile);
        $article->setImage($image);
        $article->setCreationDate($creation_date);
        $this->entityManager->persist($article);
        $this->entityManager->flush();
        $this->logger->info($article->getTitre());
    }

    public function getEntityManager(){
       return $this->entityManager->getRepository(Articles::class);
    }
}