<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Form\PostType;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class BlogController
 * @package App\Controller\Admin
 * @Route("/admin/article", name="admin_blog_")
 */
class BlogController extends AbstractController
{
    /**
     * Permet de créer un article
     *
     * @Route("/creer", name="create")
     * @return Response
     */
    public function create(Request $request, ObjectManager $manager){
        $post = new Post();

        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($post);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'article <strong> {$post->getTitle()} </strong> a bien été enregistré."
            );
            
            return $this->redirectToRoute('post_show', [
                'slug' => $post->getSlug()
            ]);
        }

        return $this->render('backend/admin/blog/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
