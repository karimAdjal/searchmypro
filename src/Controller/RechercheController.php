<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RechercheController extends AbstractController
{
    #[Route('/recherche', name: 'app_recherche')]
    public function index(): Response
    {
       
        $user = $this->getUser();
       
        return $this->render('recherche/index.html.twig', [
            'controller_name' => 'RechercheController',
            'user' => $user, 
        ]);
   
    }
}
