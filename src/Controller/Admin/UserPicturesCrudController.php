<?php

namespace App\Controller\Admin;

use App\Entity\UserPictures;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserPicturesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UserPictures::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
