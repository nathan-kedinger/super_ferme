<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SuperFermeController extends AbstractController
{
    #[Route('/la-super-ferme', name: 'super_ferme')]
    public function index(): Response
    {
        return $this->render('super_ferme/index.html.twig');
    }
}
