<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class QuotationController extends AbstractController
{
    /**
     * @Route("/devis", name="quotation")
     */
    public function index()
    {
        return $this->render('quotation/quotation_home.html.twig');
    }

}
