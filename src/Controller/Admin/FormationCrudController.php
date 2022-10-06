<?php

namespace App\Controller\Admin;

use App\Entity\Formation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FormationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Formation::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
        TextField::new('name', 'Nom de l\'événement'),
        DateField::new('date', 'Date début'),
        NumberField::new('duration', 'Durée'),
        NumberField::new('capacity', 'Places disponibles (optionnel)'),
        NumberField::new('places_left', 'Places restantes (optionnel)'),
        MoneyField::new('price', 'Prix')->setCurrency('EUR'),
        MoneyField::new('completePrice', 'Prix complet')->setCurrency('EUR'),
        ImageField::new('illustration', 'Image')
        ->setBasePath('pictures/')
        ->setUploadDir('public/pictures/')
        ->setUploadedFileNamePattern('[randomhash].[extension]')
        ->setRequired(false),
        TextareaField::new('description', 'Description'),
        ];

    }
}