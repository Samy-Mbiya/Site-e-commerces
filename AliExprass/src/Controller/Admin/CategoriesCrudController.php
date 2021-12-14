<?php

namespace App\Controller\Admin;

use App\Entity\Categories;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class CategoriesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Categories::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(), // Il ne sera pas affiché au formilaire,
            TextField::new('name'),
            TextEditorField::new('description'),
            ImageField::new('image')->setBasePath('/assets/uploads/categories/') //la ou on va rechercher les images
                ->setUploadDir('public/assets/uploads/categories/') //la ou on va stoquer  les image
                ->setUploadedFileNamePattern('[randomhash].[extension]') // Permet de determiner l'extention et de nommer differament les image mm s'ils sont identique 
                ->setRequired(false), // Le champne pas obligatoire         
        ];
    }
}
