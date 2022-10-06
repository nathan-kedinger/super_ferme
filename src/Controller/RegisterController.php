<?php

namespace App\Controller;

use App\Class\MailClass;
use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/inscription', name: 'register')]
    public function index(Request $request, UserPasswordHasherInterface $encoder, EntityManagerInterface $em): Response
    {
        $notification =null;

        $user = new User();
        $form= $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();

            $search_email =$this->em->getRepository(User::class)->findOneByEmail($user->getEmail());

            if(!$search_email){
                $password = $encoder->hashPassword($user, $user->getPassword());
    
                $user->setPassword($password);
    
                $em->persist($user);
                $em->flush();

                $mail = new MailClass();
                $content= "Bonjour".$user->getFirstname()."<br> Bienvenu sur le site de la Super Ferme et merci pour votre inscription.";
                $mail->send($user->getEmail(),$user->getFirstname(),'Bienvenue sur la Super Ferme', $content );

                $notification = "Votre inscription s'est correctement déroulée";
            } else {
                $notification = "L'email que vous avez renseigné existe déjà";
            }


        }
        
        return $this->render('register/index.html.twig', [
            'form' => $form->createView(), 
            'notification' => $notification
        ]);
    }
}
