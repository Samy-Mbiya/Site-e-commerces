<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(), // Il ne sera pas affiché au formilaire
            TextField::new('name'),
            SlugField::new('slug')->setTargetFieldName('name')->hideOnIndex(), // Copie automatiquement le champs name
            TextEditorField::new('description'),
            TextEditorField::new('moreInformations')->hideOnIndex(), // Ne peut pas etre afficher sur l'index
            MoneyField::new('price')->setCurrency('USD'), // Afficher la monnaie en USD
            IntegerField::new('quantity'),
            TextField::new('tags'),
            BooleanField::new('isBestSeller', 'Best Seller'), // LA deuxieme partie detrmine le titre dans l'affichage 
            BooleanField::new('isNewArrival', 'New Arrival '),
            BooleanField::new('isFeatured', 'Featured'),
            BooleanField::new('isSpecialOffer', 'Special Offer'),
            AssociationField::new('category'),
            ImageField::new('image')->setBasePath('/assets/uploads/products/') //la ou on va rechercher les images
                ->setUploadDir('public/assets/uploads/products/') //la ou on va stoquer  les image
                ->setUploadedFileNamePattern('[randomhash].[extension]') // Permet de determiner l'extention et de nommer differament les image mm s'ils sont identique 
                ->setRequired(false), // Le champne pas obligatoire     
        ];
    }
}
