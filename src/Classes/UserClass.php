<?php
namespace App\Classes;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserClass{
    
    public function __construct(EntityManagerInterface $em){
        $this->em =$em;        
    }

    public function userList(){
        $user = $this->em->getRepository(User::class)->findAll();

        return $user;
    }
}