<?php

namespace App\Controller;

use App\Form\ModifyInformationsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ModifInformationsController extends AbstractController
{
    #[Route('/compte/modifier-mes-informations', name: 'change_informations')]
    public function index(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $encoder): Response
    {
        $notification = null;

        $user = $this->getUser();
        $form = $this->createForm(ModifyInformationsType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $old_password = $form->get('old_password')->getData();

            if($encoder->isPasswordValid($user, $old_password )) {
                $new_password = $form->get('new_password')->getData();
                $password = $encoder->hashPassword($user, $new_password);

                $user->setPassword($password);
                $entityManager->flush();

                $notification = 'Votre mot de passe a bien été mis à jour';
            } else {
                $notification = "Votre mot de passe actuel n'est pas le bon";
            }
        }

        return $this->render('account/modifInformations.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }    
}
