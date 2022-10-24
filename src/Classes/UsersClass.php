<?php
namespace App\Classes;

use App\Entity\Newsletters\Users;
use Doctrine\ORM\EntityManagerInterface;

class UsersClass{
    
    public function __construct(EntityManagerInterface $em){
        $this->em =$em;        
    }

    public function usersList(){
        $users = $this->em->getRepository(Users::class)->findAll();

        return $users;
    }
}