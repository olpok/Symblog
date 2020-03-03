<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(ArticleRepository $repo)
    {
       // $repo=$this->getDoctrine()->getRepository(Article::class);
        $articles=$repo->findAll();

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
        ]);
    }
    
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('blog/home.html.twig', [
            'controller_name' => 'BlogController'  
        ]);
    }

     /**
     * @Route("/blog/{id}", name="blog_show")
     */
    public function show(Article $article)
    {
        return $this->render('blog/show.html.twig', [
              'article' => $article
        ]);
    }
}
