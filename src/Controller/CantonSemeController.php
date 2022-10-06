<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CantonSemeController extends AbstractController
{
    #[Route('/canton-seme', name: 'canton_seme')]
    public function index(): Response
    {
        return $this->render('canton_seme/index.html.twig');
    }
}
