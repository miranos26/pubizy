<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Post;
use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $adminRole = new Role();
        $adminRole->setTitle('ROLE_ADMIN');
        $manager->persist($adminRole);

        $adminUser = new User();
        $adminUser->setFirstname('Kevin')
                  ->setLastname('Cadier')
                  ->setEmail('contact@pubizy.fr')
                  ->setHash($this->encoder->encodePassword($adminUser, 'password'))
                  ->addUserRole($adminRole);

        $manager->persist($adminUser);


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
