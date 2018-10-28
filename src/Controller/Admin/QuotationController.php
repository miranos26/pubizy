<?php

namespace App\Controller\Admin;

use App\Entity\Quotation;
use App\Repository\QuotationRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuotationController extends AbstractController
{
    /**
     * @Route("/admin/devis", name="admin_quotation")
     */
    public function index(QuotationRepository $repo)
    {
        $quotations = $repo->findBy([],[
            'createdAt' => 'DESC'
            ]);

        return $this->render('backend/admin/quotation/index.html.twig', [
            'quotations'=> $quotations
        ]);
    }

    /**
     * Permet d'afficher un devis en détail
     *
     * @Route("/admin/devis/{id}/voir", name="admin_quotation_show")
     * @IsGranted("ROLE_ADMIN")
     * @param Quotation $quotation
     * @return Response
     */
    public function show(Quotation $quotation, ObjectManager $manager){

        $quotation->setIsNew(false);

        $manager->persist($quotation);
        $manager->flush();

        return $this->render('backend/admin/quotation/show.html.twig', [
            'quotation' => $quotation
        ]);
    }


    /**
     * Permet de marquer un devis comme accepté
     *
     * @Route("/admin/devis/{id}/valider", name="admin_quotation_accepted")
     * @param Quotation $quotation
     * @param ObjectManager $manager
     */
    public function validate(Quotation $quotation, ObjectManager $manager){

        $quotation->setIsAccepted(true);

        $manager->persist($quotation);
        $manager->flush();

        return $this->redirectToRoute('admin_quotation');
    }

    /**
     * Permet de marquer un devis comme refusé
     *
     * @Route("/admin/devis/{id}/refuser", name="admin_quotation_refused")
     * @param Quotation $quotation
     * @param ObjectManager $manager
     */
    public function refuse(Quotation $quotation, ObjectManager $manager){
        $quotation->setIsAccepted(false);

        $manager->persist($quotation);
        $manager->flush();

        return $this->redirectToRoute('admin_quotation');
    }

    /**
     * Permet de marquer un devis comme en attente
     *
     * @Route("/admin/devis/{id}/attente", name="admin_quotation_waiting")
     * @param Quotation $quotation
     * @param ObjectManager $manager
     */
    public function waitingForReponse(Quotation $quotation, ObjectManager $manager){
        $quotation->setIsAccepted(null);

        $manager->persist($quotation);
        $manager->flush();

        return $this->redirectToRoute('admin_quotation');
    }

    /**
     * Permet de supprimer une demande de devis
     *
     * @Route("/admin/devis/{id}/supprimer", name="admin_quotation_delete")
     * @IsGranted("ROLE_ADMIN")
     * @param Quotation $quotation
     * @param ObjectManager $manager
     */
    public function delete(Quotation $quotation, ObjectManager $manager){
        $manager->remove($quotation);
        $manager->flush();

        $this->addFlash(
            'success',
            "Le devis <strong>{$quotation->getId()} </strong> a bien été supprimé "
        );

        return $this->redirectToRoute('admin_quotation');
    }
}
