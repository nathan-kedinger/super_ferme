<?php
namespace App\Classes;

use App\Entity\EventsPictures;
use Doctrine\ORM\EntityManagerInterface;

class EventsPicturesClass{
    
    public function __construct(EntityManagerInterface $em){
        $this->em =$em;        
    }

    public function eventsList(){
        $eventsPictures = $this->em->getRepository(EventsPictures::class)->findAll();

        return $eventsPictures;
    }
}