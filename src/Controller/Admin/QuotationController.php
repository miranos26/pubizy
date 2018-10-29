<?php

namespace App\Controller\Admin;

use App\Entity\Quotation;
use App\Form\QuotationResponseType;
use App\Repository\QuotationRepository;
use App\Repository\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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

    /**
     * Permet de réponse à une demande de devis
     *
     * @Route("/admin/devis/{id}/repondre", name="admin_quotation_response")
     * @IsGranted("ROLE_ADMIN")
     * @param  Request $request
     * @param ObjectManager $manager
     */
    public function response(Quotation $quotation, ObjectManager $manager, Request $request, UserRepository $userRepository)
    {

        $form = $this->createForm(QuotationResponseType::class, $quotation);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            if(($form->get('responseAttachment')->getData() !== null)){
                /** @var UploadedFile  $file */
                $file = $form->get('responseAttachment')->getData();

                $date = date('dmY');

                $filename = 'D-'.$date.'-'.$quotation->getId();

                $fileName = $filename.'.'.$file->guessExtension();


                $quotationEmail = $quotation->getEmail();

                $user = $userRepository->findOneBy([
                    'email' => $quotationEmail
                ]);

                $quotation->setUser($user);

                // Move the file to directory where images are stores
                $file->move(
                    $this->getParameter('upload_directory'),
                    $fileName
                );

                $quotation->setResponseAttachment($fileName);
            }

            $manager->persist($quotation);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le devis <strong>{$quotation->getId()} </strong> a bien été envoyé "
            );
        }

        return $this->render('backend/admin/quotation/response.html.twig', [
            'quotation' => $quotation,
            'form' => $form->createView()
        ]);


    }
}
