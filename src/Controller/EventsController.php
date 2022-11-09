<?php

namespace App\Controller;

use App\Classes\EventsClass;
use App\Classes\EventsPicturesClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventsController extends AbstractController
{
    #[Route('/evenements', name: 'events')]
    public function index(EventsClass $events, EventsPicturesClass $eventsPictures): Response
    {
        return $this->render('events/index.html.twig', [
            'events' => $events->eventsList(),
            'eventsPictures'=> $eventsPictures->eventsList()
        ]);
    }
}
