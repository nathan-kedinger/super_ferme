<?php

namespace App\Controller;

use App\Classes\EventsClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(EventsClass $event): Response
    {

        $events = $event->eventsList();

        return $this->render('home/index.html.twig', [
            'events' => $events,
        ]);
    }
}
