<?php

namespace App\Controller;

use App\Classes\FormationClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormationsController extends AbstractController
{
    #[Route('/formations', name: 'formations')]
    public function index(FormationClass $formations): Response
    {
        return $this->render('formations/index.html.twig', [
            'formations' => $formations->formationsList()
        ]);
    }
}
