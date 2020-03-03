<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i <= 10; $i++) { 
            $article = new Article();
            $article->setTitle("Titre de l'art n° $i")
                    ->setContent("<p>Contenu de l'art n° $i</p>")
                    ->setImage("https://via.placeholder.com/350x150")
                    ->setCreatedAt(new \DateTime());
            $manager->persist($article);
        }

        $manager->flush();
    }
}
