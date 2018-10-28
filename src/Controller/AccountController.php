<?php

namespace App\Controller;

use App\Entity\PasswordUpdate;
use App\Entity\User;
use App\Form\AccountType;
use App\Form\PasswordUpdateType;
use App\Form\RegistrationType;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AccountController extends AbstractController
{

    /**
     * Permet d'afficher et de gérer le formulaire de connexion
     * @Route("/connexion", name="account_login")
     * @return Response
     */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();

        return $this->render('backend/account/login.html.twig', [
            'hasError' => $error !== null,
            'username' => $username
    ]);
    }

    /**
     * Permet de se déconnecter de son compte
     *
     * @Route("/deconnexion", name="account_logout")
     * @return void
     *
     */
    public function logout() {
        // C'est symfony qui gère la fonction dans le security.yaml
    }


    /**
     * Permet d'afficher le formulaire d'inscription
     *
     * @Route("/inscription", name="account_register")
     * @return Response
     */
    public function register(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder) {
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->encodePassword($user, $user->getHash());
            $user->setHash($hash);

            $manager->persist($user);
            $manager->flush();
            
            $this->addFlash(
                'success',
                'Votre compte a bien été créé ! Vous pouvez maintenant vous connecter.'
            );

            return $this->redirectToRoute('account_login');
        }

        return $this->render('backend/account/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * Permet d'afficher et de traiter le formulaire de modification de profil
     *
     * @Route("/mon-espace-client/profil", name="account_profile")
     * @IsGranted("ROLE_USER")
     * @return Response
     */
    public function profile(Request $request, ObjectManager $manager){
        $user = $this->getUser();

        $form = $this->createForm(AccountType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($user);
            $manager->flush();
            
            $this->addFlash(
                'success',
                "La modification de votre profil a bien été enregistrée"
            );
        }

        return $this->render('backend/account/profile.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet de modifier le mot de passe
     *
     * @Route("/mon-espace-client/mot-de-passe", name="account_password")
     * @IsGranted("ROLE_USER")
     * @return Response
     */
    public function updatePassword(Request $request, UserPasswordEncoderInterface $encoder, ObjectManager $manager){
        $passwordUpdate = new PasswordUpdate();

        $user = $this->getUser();

        $form = $this->createForm(PasswordUpdateType::class, $passwordUpdate);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // Vérifier que l'ancien password du form soit le même que celui tapper dans le formulaire
            if(!password_verify($passwordUpdate->getOldPassword(), $user->getHash())){
                // Il y a une erreur
                $form->get('oldPassword')->addError(new FormError('Le mot de passe que vous avez tapé n\' est pas votre mot de passe actuel'));
            } else {
                // on a bien le même password
                $newPassword = $passwordUpdate->getNewPassword();
                $hash = $encoder->encodePassword($user, $newPassword);

                $user->setHash($hash);

                $manager->persist($user);
                $manager->flush();
                
                $this->addFlash(
                    'success',
                    'Votre mot de passe a bien été modifié'
                );

                return $this->redirectToRoute('account_index');
            }
        }

        return $this->render('backend/account/password.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'afficher le profil de l'utilisateur connecté
     *
     * @Route("/mon-espace-client", name="account_index")
     * @IsGranted("ROLE_USER")
     * @return Response
     */
    public function MyAccount()
    {

        $user = $this->getUser();
        $orders = $user->getOrders()->getValues();


        return $this->render('backend/account/index.html.twig', [
            'user' => $this->getUser()
        ]);
    }

}
