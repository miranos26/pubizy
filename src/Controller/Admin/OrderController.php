<?php

namespace App\Controller\Admin;

use App\Entity\Order;
use App\Entity\User;
use App\Form\OrderType;
use App\Repository\OrderRepository;
use App\Repository\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends AbstractController
{
    /**
     * @Route("/admin/commandes", name="admin_order")
     */
    public function index(OrderRepository $repo)
    {
        $orders = $repo->findBy([],[
            'createdAt' => 'DESC'
        ]);

        return $this->render('backend/admin/order/index.html.twig',[
            'orders' => $orders
        ]);
    }

    /**

    /**
     * Permet de créer une nouvelle commande
     *
     * @Route("/admin/commande/creer", name="admin_order_create")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     */
    public function create(Request $request, ObjectManager $manager, UserRepository $userRepository){

        $order = new Order();

        $form = $this->createForm(OrderType::class, $order);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $orderEmail = $order->getClientEmail();

            $user = $userRepository->findOneBy([
                'email' => $orderEmail
            ]);

            if($user){
                $order->setUser($user);
            }

            $manager->persist($order);
            $manager->flush();

            $this->addFlash(
                'success',
                "La commande <strong> {$order->getName()} </strong> a bien été crée."
            );

            return $this->redirectToRoute('admin_order');
        }

        return $this->render('backend/admin/order/create.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * Permet d'afficher le formulaire d'édition
     *
     * @Route("/admin/commande/{id}/modifier", name="admin_order_edit")
     * @IsGranted("ROLE_ADMIN")
     * @param Order $order
     * @return Response
     */
    public function edit(Order $order, Request $request, ObjectManager $manager, UserRepository $userRepository){
        $form = $this->createForm(OrderType::class, $order);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $orderEmail = $order->getClientEmail();

            $user = $userRepository->findOneBy([
                'email' => $orderEmail
            ]);

            $order->setUser($user);


            $manager->persist($order);
            $manager->flush();

            $this->addFlash(
                'success',
                "La commande <strong>{$order->getName()} </strong> a bien été modifiée "
            );
        }

        return $this->render('backend/admin/order/edit.html.twig', [
            'order' => $order,
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet de supprimer une commande
     *
     * @Route("/admin/commande/{id}/supprimer", name="admin_order_delete")
     * @IsGranted("ROLE_ADMIN")
     * @param Order $order
     * @param ObjectManager $manager
     */
    public function delete(Order $order, ObjectManager $manager){
        $manager->remove($order);
        $manager->flush();

        $this->addFlash(
            'success',
            "La commande <strong>{$order->getName()} </strong> a bien été supprimée "
        );

        return $this->redirectToRoute('admin_order');
    }

}
