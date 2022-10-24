<?php

namespace App\Controller\Admin;

use App\Entity\Carousel;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CarouselCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Carousel::class;
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
            TextField::new('title', 'Titre sur l\'image (facultatif)'),
            TextField::new('text', 'Texte sur l\'image (facultatif)'),
        ];
    }
    
}
