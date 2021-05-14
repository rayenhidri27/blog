<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    private $repoArticle;

    public function __construct(ArticleRepository $repoArticle)
    {
        $this->repoArticle = $repoArticle;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $articles = $this->repoArticle->findAll();
        return $this->render('home/index.html.twig', [
            "articles" => $articles
        ]);
    }

    /**
     * @Route("/show/{id}", name="show")
     */
    public function show(Article $article): Response
    {
        if (!$article) {
            $this->redirectToRoute("home");
        }
        return $this->render('show/index.html.twig', [
            "article" => $article
        ]);
    }
}
