<?php

namespace App\Controller;

use App\Class\MailClass;
use App\Entity\ResetPassword;
use App\Entity\User;
use App\Form\ResetPasswordType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ResetPasswordController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/mot-de-passe-oublie', name: 'reset_password')]
    public function index(Request $request): Response
    {
        

        if($this->getUser()){
            return $this->redirectToRoute('home');
        }

        if($request->get('email')){
            $user = $this->em->getRepository(User::class)->findOneByEmail($request->get('email'));

            if($user){

                // 1 : Ennregistrer en base la demande de reset_password avec user, token, createdAt
                $reset_password = new ResetPassword();
                $reset_password->setUser($user);
                $reset_password->setToken(uniqid());
                $reset_password->setCreatedAt(new DateTime());
                $this->em->persist($reset_password);
                $this->em->flush();

                //2 : Envoyer un mail à l'utilisateur avec un lien pour mettre à jour son mot de passe.

                $url = $this->generateUrl('update_password', [
                    'token' => $reset_password->getToken()
                ]);

                $content = "Bonjour ".$user->getFirstname()."<br> Vous avez demandé à réinitialiser votre mot de passe sur
                le site de la Super Ferme.<br><br>";
                $content .= "Merci de bien vouloir cliquer sur le lien suivant pour <a href='".$url."'>mettre votre mot de passe à jour.</a>";

                $mail = new MailClass();
                $mail->send($user->getEmail(), $user->getFirstname(). ' '.$user->getName(), 'Réinitialisation de votre mot de passe sur La Super Ferme', $content);
                $this->addFlash('notice', 'Vous allez recevoir un mail dans quelques secondes avec la procédure pour 
                réinitialiser votre mot de passe.');

            } else {
                $this->addFlash('notice', 'Cette adresse email est inconnue.');
            }
        }
        return $this->render('reset_password/index.html.twig');
    }

    #[Route('/modifier-mon-mot-de-passe/{token}', name: 'update_password')]
    public function update(Request $request, $token, UserPasswordHasherInterface $encoder)
    {
        $reset_password= $this->em->getRepository(ResetPassword::class)->findOneByToken($token);

        if(!$reset_password){
            return $this->redirectToRoute('reset_password');
        }
        //vérifier si le createdAt est égal à maintenant
        $now = new DateTime();

        if($now > $reset_password->getCreatedAt()->modify('+ 3 hour')){
            $this->addFlash('notice', 'Votre demande de mot de passe à expiré, merci de la renouveller');
            return $this->redirectToRoute('reset_password');
        }

        //rendre une vue avec mot de passe et confirmer le mot de passe
        $form = $this->createForm(ResetPasswordType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $new_password = $form->get('new_password')->getData();

           // Encodage des passwords
            $password = $encoder->hashPassword($reset_password->getUser(), $new_password);
            $reset_password->getUser()->setPassword($password);
           
            //Flush en base de données
            $this->em->flush();

            // redirection de l'utilisateur vers la page de connexion
            $this->addFlash('notice', 'Votre mot de passe a bien été mis à jour.');
            return $this->redirectToRoute('login');
        }

        return $this->render('reset_password/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
