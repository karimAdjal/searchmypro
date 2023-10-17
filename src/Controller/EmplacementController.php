<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmplacementController extends AbstractController
{
    #[Route('/emplacement', name: 'app_emplacement')]
    public function index(): Response
    {
        return $this->render('emplacement/index.html.twig', [
            'controller_name' => 'EmplacementController',
        ]);
    }
}
