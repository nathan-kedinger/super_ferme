<?php
namespace App\Classes;

use App\Entity\Formation;
use Doctrine\ORM\EntityManagerInterface;

class FormationClass{
    
    public function __construct(EntityManagerInterface $em){
        $this->em =$em;        
    }

    public function formationsList(){
        $formations = $this->em->getRepository(Formation::class)->findAll();

        return $formations;
    }
}