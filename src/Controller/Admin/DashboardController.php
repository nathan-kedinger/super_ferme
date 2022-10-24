<?php

namespace App\Controller\Admin;

use App\Entity\Carousel;
use App\Entity\Events;
use App\Entity\Formation;
use App\Entity\Newsletters\Users;
use App\Entity\Products;
use App\Entity\UniqProduct;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

        return $this->render('admin/index.html.twig');

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Site Super Ferme');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Images caroussel', 'fas fa-image', Carousel::class);
        yield MenuItem::linkToCrud('Paniers', 'fas fa-carrot', Products::class);
        yield MenuItem::linkToCrud('Produits', 'fas fa-carrot', UniqProduct::class);
        yield MenuItem::linkToCrud('Évenements', 'fas fa-calendar-days', Events::class);
        yield MenuItem::linkToCrud('Formations', 'fas fa-calendar-days', Formation::class);
        yield MenuItem::linkToCrud('Newsletters', 'fas fa-envelopes-bulk', Users::class);
        yield MenuItem::linkToRoute('Retour au site', 'fas fa-right-from-bracket', 'account');
        yield MenuItem::linkToLogout('Déconnexion', 'fas fa-power-off');
    }
}
