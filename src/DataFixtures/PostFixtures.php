<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');

        // Créer 3 catégories fakées
        for($i = 1; $i <= 3; $i++) {
            $category = new Category();
            $category->setTitle($faker->sentence());
            $manager->persist($category);

        }

        for($j = 1; $j <= 6; $j++){


            $title = $faker->sentence(3);

            $post = new Post();

            $post->setTitle($title)
                 ->setContent($faker->paragraphs(5,true))
                 ->setImage($faker->imageUrl())
                 ->setCreatedAt($faker->dateTimeBetween('-6 months'))
                 ->setAuthor("Publié par Pubizy")
                 ->setCategoryLink($category);

            // On se prépare à faire persister l'article, mais ne le créé par encore en base de donnée
            $manager->persist($post);
        }

        // C'est manager->flush qui va balancer les requêtes pour que ça soit créé en base de donnée.
        $manager->flush();
    }
}
