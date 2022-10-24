<?php

namespace App\Controller;

use App\Classes\UserClass;
use App\Classes\UsersClass;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminAccountController extends AbstractController
{    
    public function __construct(EntityManagerInterface $em){
        $this->em =$em;        
    }

    #[Route('/admin/liste-clients', name: 'client_list')]
    public function index(UserClass $user, UsersClass $users): Response
    {


        return $this->render('admin/client_list.html.twig', [
            'users' => $users->usersList(),
            'user' => $user->userList(),
        ]);
    }
}
