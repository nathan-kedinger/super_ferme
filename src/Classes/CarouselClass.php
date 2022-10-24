<?php
namespace App\Classes;

use App\Entity\Carousel;
use Doctrine\ORM\EntityManagerInterface;

class CarouselClass{
    
    public function __construct(EntityManagerInterface $em){
        $this->em =$em;        
    }

    public function imgList(){
        $formations = $this->em->getRepository(Carousel::class)->findAll();

        return $formations;
    }
}