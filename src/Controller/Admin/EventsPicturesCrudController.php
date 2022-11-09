<?php

namespace App\Controller\Admin;

use App\Entity\EventsPictures;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EventsPicturesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EventsPictures::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom de l\'image'),
            ImageField::new('illustration', 'Images caroussel page d\'accueil')
            ->setBasePath('pictures/')
            ->setUploadDir('public/pictures/')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false),
        ];
    }
    
}
