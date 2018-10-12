<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FrontendController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('frontend/index.html.twig');
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

    /**
     * @Route("/devis", name="devis")
     */
    public function quotation()
    {
        return $this->render('quotation/quotation_home.html.twig');
    }

}
