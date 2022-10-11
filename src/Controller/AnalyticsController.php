<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnalyticsController extends AbstractController
{
    #[Route('/analytics', name: 'app_analytics')]
    public function index(): Response
    {
        return $this->render('analytics/index.html.twig', [
            'controller_name' => 'AnalyticsController',
        ]);
    }
}
