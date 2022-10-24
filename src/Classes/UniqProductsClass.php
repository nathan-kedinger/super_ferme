<?php
namespace App\Classes;

use App\Entity\UniqProduct;
use Doctrine\ORM\EntityManagerInterface;

class UniqProductsClass{
    
    public function __construct(EntityManagerInterface $em){
        $this->em =$em;        
    }

    public function uniqProductList(){
        $uniqProducts = $this->em->getRepository(UniqProduct::class)->findAll();

        return $uniqProducts;
    }
}