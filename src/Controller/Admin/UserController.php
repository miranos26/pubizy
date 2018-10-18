<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/mon-compte/{slug}", name="user_account")
     */
    public function index(User $user)
    {
        return $this->render('backend/account/index.html.twig', [
            'user' => $user
        ]);
    }
}
