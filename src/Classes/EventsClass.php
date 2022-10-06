<?php
namespace App\Classes;

use App\Entity\Events;
use Doctrine\ORM\EntityManagerInterface;

class EventsClass{
    
    public function __construct(EntityManagerInterface $em){
        $this->em =$em;        
    }

    public function eventsList(){
        $events = $this->em->getRepository(Events::class)->findAll();

        return $events;
    }
}