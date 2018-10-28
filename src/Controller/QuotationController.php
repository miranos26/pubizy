<?php

namespace App\Controller;

use App\Entity\Quotation;
use App\Form\QuotationType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class QuotationController extends AbstractController
{
    /**
     * @Route("/nouveau-projet", name="quotation")
     */
    public function index(Request $request, ObjectManager $manager)
    {
        $quotation = new Quotation();
        $form = $this->createForm(QuotationType::class, $quotation);
        $form->handleRequest($request);

        dump($form->get('reference')->getData());

        if($form->isSubmitted() && $form->isValid()){

            if(($form->get('reference')->getData() !== null)){
            /** @var UploadedFile  $file */
            $file = $form->get('reference')->getData();

            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            // Move the file to directory where images are stores
            $file->move(
                $this->getParameter('upload_directory'),
                $fileName
            );

            $quotation->setReference($fileName);
            }


            $manager->persist($quotation);
            $manager->flush();

            return $this->redirectToRoute('quotation_success');
        }

        return $this->render('quotation/index.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/nouveau-projet/succes", name="quotation_success")
     */
    public function success(){
        return $this->render('quotation/success.html.twig');
    }

    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }


}
