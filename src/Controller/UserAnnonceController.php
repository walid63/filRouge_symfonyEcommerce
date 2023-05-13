<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserAnnonceController extends AbstractController
{
    #[Route('/user/annonce', name: 'app_user_annonce')]
    public function index(): Response
    {
        return $this->render('user_annonce/index.html.twig', [
            'controller_name' => 'UserAnnonceController',
        ]);
    }
}
