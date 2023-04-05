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
    public function details(Autos $gewicht): Response
    {
        $autoGewicht = $gewicht->getGewicht();
        return $this->render('bezoeker/details.html.twig',[
            'gewicht'=>$autoGewicht
        ]);
    }

    #[Route('/update/{id}', name:'app_update')]
    public function update(): Response
    {
        return $this->render('bezoeker/update.html.twig');
    }
}