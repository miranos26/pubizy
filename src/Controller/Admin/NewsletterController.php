<?php

namespace App\Controller\Admin;

use App\Entity\Newsletter;
use App\Repository\NewsletterRepository;
use App\Repository\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NewsletterController extends AbstractController
{
    /**
     * @Route("/admin/newsletter", name="admin_newsletter")
     */
    public function index(NewsletterRepository $repo, UserRepository $userRepository)
    {
        $newsletterSuscribers = $repo->findBy([],[
            'createdAt' => 'DESC'
        ]);

        $usersSuscribers = $userRepository->findAll();

        return $this->render('backend/admin/newsletter/index.html.twig', [
            'newsletterSuscribers' => $newsletterSuscribers,
            'usersSuscribers' => $usersSuscribers
        ]);
    }

    /**
     * Permet de supprimer une entrée newsletter
     *
     * @Route("/admin/newsletter/{id}/supprimer", name="admin_newsletter_delete")
     * @IsGranted("ROLE_ADMIN")
     * @param Newsletter $newsletter
     * @param ObjectManager $manager
     */
    public function delete(Newsletter $newsletter, ObjectManager $manager){
        $manager->remove($newsletter);
        $manager->flush();

        $this->addFlash(
            'success',
            "L'entrée newsletter <strong>{$newsletter->getId()} </strong> a bien été supprimée "
        );

        return $this->redirectToRoute('admin_newsletter');
    }

}
