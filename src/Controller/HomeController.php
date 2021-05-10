<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ArticleRepository $repoArticle): Response
    {
        $articles= $repoArticle->findAll();
        return $this->render('home/index.html.twig',[
            "articles"=>$articles
        ]);
    }

    /**
     * @Route("/show/{id}", name="show")
     */
    public function show(ArticleRepository $repoArticle, $id): Response
    {
        $article = $repoArticle->find($id);
        if(!$article){
            $this->redirectToRoute("home");
        }
        return $this->render('show/index.html.twig', [
            "article" => $article
        ]);
    }
}
