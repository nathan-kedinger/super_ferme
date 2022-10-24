<?php

namespace App\Controller\Admin;

use App\Entity\Newsletters\Users;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UsersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Users::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('email', 'Email'),
            DateTimeField::new('createdAt','Inscrit depuis le'),
            BooleanField::new('isAgreed', 'Accord')
        ];
    }
    
}
