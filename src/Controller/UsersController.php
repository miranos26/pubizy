<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;


class UsersController extends AbstractController
{
    /**
     * @Route("/mon-compte", name="userAccount")
     */
    public function index()
    {
        return $this->render('users/index.html.twig', [
            'controller_name' => 'UsersController',
        ]);
    }

    /**
     * Injection de dépendance : classe Request de HttpFoundatation (permet d'analyser / manipuler les req HTTP)
     * @Route("/inscription", name="suscribe")
     */
    public function suscribe(Request $request, ObjectManager $manager)
    {
        return $this->render('frontend/suscribe.html.twig');
    }


}
