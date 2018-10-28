<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/admin/utilisateurs", name="admin_usersList")
     * @IsGranted("ROLE_ADMIN")
     */
    public function getUserList(UserRepository $repo)
    {
        $users = $repo->findBy([],[
            'createdAt' => 'DESC'
        ]);

        return $this->render('backend/admin/users/index.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * Permet de créer un nouvel utilisateur
     *
     * @Route("/admin/utilisateur/new", name="admin_user_create")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     */
    public function create(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder){
        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->encodePassword($user, $user->getHash());
            $user->setHash($hash);
            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'utilisateur <strong> {$user->getLastname()} </strong> a bien été créé."
            );

            return $this->redirectToRoute('admin_usersList');
        }

        return $this->render('backend/admin/users/create.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * Permet d'afficher le formulaire d'édition
     *
     * @Route("/admin/users/{id}/modifier", name="admin_user_edit")
     * @IsGranted("ROLE_ADMIN")
     * @param User $user
     * @return Response
     */
    public function edit(User $user, Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder){
        $form = $this->createForm(UserType::class, $user);

        $hash = $user->getHash();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            if($user->getHash() !== ''){
                $hash = $encoder->encodePassword($user, $user->getHash());
            }

            $user->setHash($hash);

            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'utilisateur <strong>{$user->getLastname()} </strong> a bien été modifié "
            );
        }

        return $this->render('backend/admin/users/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet de supprimer un utilisateur
     *
     * @Route("/admin/users/{id}/supprimer", name="admin_user_delete")
     * @IsGranted("ROLE_ADMIN")
     * @param User $user
     * @param ObjectManager $manager
     */
    public function delete(User $user, ObjectManager $manager){
        $manager->remove($user);
        $manager->flush();

        $this->addFlash(
            'success',
            "L'utilisateur a bien été supprimé"
        );
        
        return $this->redirectToRoute('admin_usersList');
    }


    /**
     * Permet de désinscrire un utilisateur
     *
     * @Route("/admin/users/{id}/desinscription", name="admin_user_unsuscribe")
     * @IsGranted("ROLE_ADMIN")
     * @param User $user
     * @param ObjectManager $manager
     */
    public function Unsuscribe(User $user, ObjectManager $manager){

        $user->setIsSuscribedNewsletter(false);

        $manager->persist($user);
        $manager->flush();

        $this->addFlash(
            'success',
            "L'utilisateur a bien été désinscrit de la newsletter"
        );

        return $this->redirectToRoute('admin_newsletter');
    }
    
    
    
}
