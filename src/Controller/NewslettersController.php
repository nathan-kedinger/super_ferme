<?php

namespace App\Controller;

use App\Classes\MailClass;
use App\Entity\Newsletters\Newsletters;
use App\Entity\Newsletters\Users;
use App\Form\NewslettersEntityType;
use App\Form\NewsletterUsersType;
use App\Repository\Newsletters\NewslettersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewslettersController extends AbstractController
{
   /* #[Route('/newsletters', name: 'newsletters')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {

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
            $content= "Bonjour et bienvenue sur le site de la Super Ferme. Merci pour votre inscription à la newsletter.<br>
            Vous n'avez plus qu'à cliquer sur ce lien : <a href='".$url."'>valider mon inscription à la newsletter.</a><br>
            Si le lien d'activation ne fonctionne pas, merci de copier directement le lien suivant dans la barre de recherche de votre navigateur :
            .$url. <br>
            Si vous avez une question, n'hésitez pas à nous contacter.";
            $mail->send($user->getEmail(),'','Validation d\'inscription à la Newsletter - la Super Ferme', $content );

            $this->addFlash('message', 'Inscription en attente de validation');
            }
            else{
            $this->addFlash('message', 'Cette adresse mail est déjà inscrite à la newsletter');
            }
        }

        return $this->render('newsletters/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }*/

    #[Route('/newsletters-confirmation/{id}/{token}', name: 'newsletters_confirm')]
    public function confirm(Users $user, $token, EntityManagerInterface $em): Response
    {
        if($user->getValidationToken() != $token){
            throw $this->createNotFoundException('Page non trouvée');
        }

        $user->setIsValid(true);

        $em->persist($user);
        $em->flush();

        $this->addFlash('message', 'Votre Newsletter est maintenant activée.');

        return $this->render('newsletters/newsletters_activate.html.twig');
    
    }

    /*#[Route('admin/creation-newsletters', name: 'newsletters_create')]
    public function prepare(Request $request, EntityManagerInterface $em): Response
    {
        $newsletter = new Newsletters();
        $form = $this->createForm(NewslettersEntityType::class, $newsletter);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em->persist($newsletter);
            $em->flush();

            return $this->redirectToRoute('newsletters_list');
        }

        return $this->render('admin/newsletters.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('admin/newsletters-listes', name: 'newsletters_list')]
    public function list(NewslettersRepository $newsletters): Response
    {
        return $this->render('newsletters/newsletters_list.html.twig', [
            'newsletters' => $newsletters->findAll()
         ]);
    }

    #[Route('admin/envoie-newsletter/{id}', name: 'send')]
    public function send(Users $users, MailClass $mail): Response
    {
        foreach($users as $user){
            if($user->getIsvalid()){
                $mail = new MailClass();
                $content= "Bonjour et bienvenue sur le site de la Super Ferme. Merci pour votre inscription à la newsletter.<br>
                Vous n'avez plus qu'à cliquer sur ce lien : <a href='".$url."'>valider mon inscription à la newsletter.</a><br>
                Si le lien d'activation ne fonctionne pas, merci de copier directement le lien suivant dans la barre de recherche de votre navigateur :
                .$url. <br>
                Si vous avez une question, n'hésitez pa sà nous contacter.";
                $mail->send($user->getEmail(),'','Validation d\'inscription à la Newsletter - la Super Ferme', $content );
    
            }
        }

    }*/
}
