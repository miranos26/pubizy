<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class BlogController
 * @package App\Controller\Admin
 */
class BlogController extends AbstractController
{

    /**
     * @Route("/admin/article", name="admin_posts_index")
     * @return Response
     */
    public function index(PostRepository $repo)
    {
        return $this->render('backend/admin/blog/index.html.twig', [
           'posts' => $repo->findAll()
        ]);
    }


    /**
     * Permet de créer un article
     *
     * @Route("/admin/article/new", name="admin_post_create")
     * @IsGranted("ROLE_ADMIN")
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


    /**
     * Permet d'afficher le formulaire d'édition
     *
     * @Route("/admin/article/{id}/modifier", name="admin_post_edit")
     * @param Post $post
     * @return Response
     */
    public function edit(Post $post, Request $request, ObjectManager $manager){
        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($post);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'article <strong>{$post->getTitle()} </strong> a bien été enregistré ! "
            );
        }

        return $this->render('backend/admin/blog/edit.html.twig', [
            'post' => $post,
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet de supprimer un article
     *
     * @Route("/admin/article/{id}/supprimer", name="admin_post_delete")
     * @IsGranted("ROLE_ADMIN")
     * @param Post $post
     * @param ObjectManager $manager
     */
    public function delete(Post $post, ObjectManager $manager){
        $manager->remove($post);
        $manager->flush();

        $this->addFlash(
            'success',
            "L'article a bien été supprimé"
        );

        return $this->redirectToRoute('admin_posts_index');
    }
}
