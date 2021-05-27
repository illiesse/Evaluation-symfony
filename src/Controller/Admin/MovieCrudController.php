<?php

namespace App\Controller\Admin;

use App\Entity\Movie;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MovieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Movie::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name');
        yield TextField::new('originalName');
        yield IntegerField::new('releaseDate');
        yield AssociationField::new('actors');
        yield AssociationField::new('genres');
        yield ImageField::new('image')->setUploadDir('/public/assets/upload/images') 
                                      ->setBasePath('/assets/upload/images');
        yield TextEditorField::new('synopsis');
        yield AssociationField::new('studio');
        yield BooleanField::new('seen');
        yield BooleanField::new('watchList');
    }
}
