<?php

namespace App\Controller;


use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * PHP Type Hinting : On fournit à Symfony des indices sur l'injection de dépendances pour qu'il nous fournisse ce dont la méthode a besoin pour fonctionner
     * Ici en paramètre de index on a besoin du repository des articles et on va le placer dans $repo (sert à charger les articles depuis la BDD != manager)
     * Ca evite de faire  $repo = $this->getDoctrine()->getRepository(Post::class);
     */
    public function index(PostRepository $repo)
    {
        // Il y a bcp de fonctions de dispo (voir la doc Doctrine), celle-ci permet de récupérer tous nos articles.
        $posts = $repo->lastPosts();

        // Ensuite on envoi la variable que l'on a récupéré depuis notre repository dans notre vue.
        return $this->render('frontend/index.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/services", name="services")
     */
    public function services()
    {
        return $this->render('frontend/services.html.twig');
    }

    /**
     * @Route("/portfolio", name="works")
     */
    public function works()
    {
        return $this->render('frontend/works.html.twig');
    }

}
