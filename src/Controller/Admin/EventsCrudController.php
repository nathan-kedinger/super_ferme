<?php

namespace App\Controller\Admin;

use App\Entity\Events;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EventsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Events::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom de l\'événement'),
            DateField::new('date', 'Date'),
            NumberField::new('availableQuantity', 'Places disponibles (optionnel)'),
            NumberField::new('bookedQuantity', 'Places réservées (optionnel)'),
            MoneyField::new('price', 'Prix (optionnel)')->setCurrency('EUR'),
            ImageField::new('illustration', 'Image')
            ->setBasePath('pictures/')
            ->setUploadDir('public/pictures/')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false),
            TextareaField::new('description', 'Description'),
            SlugField::new('slug')->setTargetFieldName('name'),
        ];
    }
}
