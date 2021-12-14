<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;

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
            TextEditorField::new('description'),
            TextEditorField::new('moreInformations'),
            MoneyField::new('price')->setCurrency('USD'), // Afficher la monnaie en USD
            BooleanField::new('isBestSeller'),
            BooleanField::new('isNewArrival'),
            BooleanField::new('isFeatured'),
            BooleanField::new('isSpecialOffer'),
            AssociationField::new('category'),
            ImageField::new('image')->setBasePath('/assets/uploads/products/') //la ou on va rechercher les images
                ->setUploadDir('public/assets/uploads/products/') //la ou on va stoquer  les image 
        ];
    }
}
