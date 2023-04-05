<?php
namespace App\Controller;

use App\Entity\Autos;
use App\Repository\AutosRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UpdateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class AutoController extends AbstractController
{
    #[Route('/home', name:'app_home')]
    public function home(ManagerRegistry $doctrine): Response
    {
        $autos = $doctrine->getRepository(Autos::class)->findAll();
        return $this->render('bezoeker/index.html.twig',[
            'autos'=>$autos
            ]);
    }

    #[route('/details/{id}', name:'app_details')]
    public function details(Autos $gewicht): Response
    {
        $autoGewicht = $gewicht->getGewicht();
        return $this->render('bezoeker/details.html.twig',[
            'gewicht'=>$autoGewicht
        ]);
    }

    #[Route('/update/{id}', name:'app_update')]
    public function update(AutosRepository $ar, Request $request, Autos $car , EntityManagerInterface $entityManager): Response
    {
        $autoId = $car->getId();
        $auto = $ar->find($autoId);
        $form = $this->createForm(UpdateType::class, $auto);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $add = $form->getData();

            $entityManager->persist($add);
            $entityManager->flush();

            $this->addFlash('warning', 'Rij gewijzigd');
            return $this->redirectToRoute('app_home');
        }

        return $this->renderForm('bezoeker/update.html.twig', [
            'form' => $form,
        ]);
    }
}