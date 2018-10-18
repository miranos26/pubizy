<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @param PostRepository $repo
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/blog", name="blog")
     */
    public function index(PostRepository $repo)
    {
        $posts = $repo->findAll();
        return $this->render('frontend/blog/index.html.twig', [
            'posts' => $posts
        ]);
    }


    /**
     * Injection de dépendance : PostRepository
     * + Grâce au Param converter, il sait que l'on veut un Post et comme il y a un {slug} dans la route, il va aller chercher tout seul le bon article
     * C'est le service container de symfony qui nous fait le boulot.
     *
     * @Route("/article/{slug}", name="post_show")
     * @return Response
     */
    public function show(Post $post)
    {
        return $this->render('frontend/blog/show.html.twig', [
            'post' => $post
        ]);
    }

}
