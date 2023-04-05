<?php
namespace App\Controller;

use App\Entity\Autos;
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
    public function details(ManagerRegistry $doctrine): Response
    {
        $gewicht = $doctrine->getRepository(Autos::class)->getGewicht();
        return $this->render('bezoeker/details.html.twig',[
            'gewicht'=>$gewicht
        ]);
    }
}