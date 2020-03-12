<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');
        //Créer 3 catégories fakées
        for ($i=1; $i <=3; $i++) { 
            $category = new Category();
            $category->setTitle($faker->sentence())
                     ->setDescription($faker->paragraph());

            $manager->persist($category);

            //Créer entre 4 et 6 articles

            for ($j=1; $j <= mt_rand(4,6); $j++) { 
                $article = new Article();

                $content= '<p>' . join($faker->paragraphs(5), '</p><p>') . '</p>'; //conversion array en string
                $article->setTitle($faker->sentence())
                        ->setContent($content)
                        ->setImage($faker->imageUrl($width = 640, $height = 480)) //imageUrl($width = 640, $height = 480)
                        ->setCreatedAt($faker->dateTimeBetween('-6 months'))
                        ->setCategory($category);

                $manager->persist($article);

                //On donne les comments à l'article

                for ($k=1; $k < mt_rand(4,10); $k++) { 
                    $comment = new Comment();
                
                //$now = new \DateTime();
                //$interval = $now->diff($article->get(createdAt));
                $interval = (new \DateTime())->diff($article->getCreatedAt());
                $days = $interval->days;
                $minimum = '-' . $days . 'days';

                $content= '<p>' . join($faker->paragraphs(2), '</p><p>') . '</p>'; //conversion array en string
                    $comment->setAuthor($faker->name)
                            ->setContent($content)
                            ->setCreatedAt($faker->dateTimeBetween($minimum))
                            ->setArticle($article);

                $manager->persist($comment);
                }
            }
            
        }

        /*
        for ($i=1; $i <= 10; $i++) { 
            $article = new Article();
            $article->setTitle("Titre de l'art n° $i")
                    ->setContent("<p>Contenu de l'art n° $i</p>")
                    ->setImage("https://via.placeholder.com/350x150")
                    ->setCreatedAt(new \DateTime());
            $manager->persist($article);
        }*/

        $manager->flush();
    }
}
