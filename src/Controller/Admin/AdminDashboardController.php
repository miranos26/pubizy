<?php

namespace App\Controller\Admin;

use App\Repository\OrderRepository;
use App\Repository\QuotationRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminDashboardController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_dashboard")
     */
    public function index(OrderRepository $orderRepository, QuotationRepository $quotationRepository, ObjectManager $manager)
    {
        $orders = $orderRepository->findBy([],[
            'createdAt' => 'DESC'
        ],5);

        $quotations = $manager->createQuery('SELECT q FROM App\Entity\Quotation q WHERE q.isNew = true')->getResult();


        return $this->render('backend/admin/index.html.twig', [
            'orders' => $orders,
            'quotations' => $quotations
        ]);
    }

}
