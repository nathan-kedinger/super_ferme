<?php

namespace App\Controller;

use App\Classes\EventsClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventsController extends AbstractController
{
    #[Route('/evenements', name: 'events')]
    public function index(EventsClass $events): Response
    {
        return $this->render('events/index.html.twig', [
            'events' => $events->eventsList()
        ]);
    }
}
