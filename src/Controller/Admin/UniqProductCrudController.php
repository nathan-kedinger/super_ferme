<?php

namespace App\Controller\Admin;

use App\Entity\UniqProduct;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UniqProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UniqProduct::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            NumberField::new('availableQuantity', 'Quantité disponible'),
            NumberField::new('bookedQuantity', 'Quantité réservée'),
            MoneyField::new('price')->setCurrency('EUR'),
            ImageField::new('illustration')
            ->setBasePath('pictures/')
            ->setUploadDir('public/pictures/')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false),
            TextField::new('subtitle'),
            TextareaField::new('description'),
            SlugField::new('slug')->setTargetFieldName('name'),
        ];
        
    }
    
}
