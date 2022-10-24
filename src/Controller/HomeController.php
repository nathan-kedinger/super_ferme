<?php

namespace App\Controller;

use App\Classes\CarouselClass;
use App\Classes\EventsClass;
use App\Classes\MailClass;
use App\Classes\NewslettersClass;
use App\Entity\Newsletters\Users;
use App\Form\NewsletterUsersType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(EventsClass $event, CarouselClass $images, Request $request, EntityManagerInterface $em): Response
    {

        $events = $event->eventsList();
        $carousel = $images->imgList();

        $user = new Users();
        $form = $this->createForm(NewsletterUsersType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $search_email =$em->getRepository(Users::class)->findOneByEmail($user->getEmail());

            if(!$search_email){
            $token = hash('sha256', uniqid());
            
            $user->setValidationToken($token);

            $em->persist($user);
            $em->flush();

            $url = $this->generateUrl('newsletters_confirm', [
                'id' => $user->getId(),
                'token' => $token,
            ]);

            $mail = new MailClass();
            $content= "Bonjour et bienvenue sur le site de la Super Ferme. Merci pour votre inscription à la newsletter.<br><br>
            Vous n'avez plus qu'à cliquer sur ce lien : <a href='".$url."'>valider mon inscription à la newsletter.</a><br><br>
            Si le lien d'activation ne fonctionne pas, merci de copier directement le lien suivant dans la barre de recherche de votre navigateur :
            .$url. <br><br>
            Si vous avez une question, n'hésitez pas à nous contacter.";
            $mail->send($user->getEmail(),'','Validation d\'inscription à la Newsletter - la Super Ferme', $content );

            $this->addFlash('message', 'Inscription en attente de validation');
            }
            else{
            $this->addFlash('message', 'Cette adresse mail est déjà inscrite à la newsletter');
            }
        }

        return $this->render('home/index.html.twig', [
            'events' => $events,
            'form' => $form->createView(),
            'carousel' => $carousel

        ]);
    }
}
