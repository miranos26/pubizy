<?php

namespace App\Controller\Admin;

use App\Entity\Work;
use App\Form\WorkType;
use App\Repository\WorkRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WorkController extends AbstractController
{
    /**
     * @Route("/admin/travaux", name="admin_works")
     */
    public function index(WorkRepository $repo)
    {
        return $this->render('backend/admin/portfolio/index.html.twig', [
            'works' => $repo->findAll(),
        ]);
    }

    /**
     * Permet de créer un item portfolio
     *
     * @Route("/admin/travail/nouveau", name="admin_work_create")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     */
    public function create(Request $request, ObjectManager $manager){
        $work = new Work();

        $form = $this->createForm(WorkType::class, $work);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            /** @var UploadedFile  $file */
            $file = $form->get('image')->getData();

            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            // Move the file to directory where images are stores
            $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
            );

            $work->setImage($fileName);

            $manager->persist($work);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'image a bien été enregistré."
            );

            return $this->redirectToRoute('admin_works');
        }

        return $this->render('backend/admin/portfolio/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }

    /**
     * Permet de supprimer une image
     *
     * @Route("/admin/travail/{id}/supprimer", name="admin_work_delete")
     * @IsGranted("ROLE_ADMIN")
     * @param Work $work
     * @param ObjectManager $manager
     */
    public function delete(Work $work, ObjectManager $manager){
        $manager->remove($work);
        $manager->flush();

        $this->addFlash(
            'success',
            "L'image a bien été supprimée"
        );

        return $this->redirectToRoute('admin_works');
    }


}
