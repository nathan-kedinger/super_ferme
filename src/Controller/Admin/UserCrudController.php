<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom'),
            TextField::new('firstname', 'Prénom'),
            BooleanField::new('booked', 'Panier réservé'),
            TextField::new('bookedPoduct', 'Type de produit reservé'),
            TextField::new('email', 'Email'),
            TextField::new('address', 'Adresse'),
            TextField::new('city', 'Ville'),
            TextField::new('postal', 'Code postal'),
            TextField::new('country', 'Pays'),
            TelephoneField::new('country', 'Pays'),
            TextField::new('company', 'Entreprise'),
            
        ];
    }
}
