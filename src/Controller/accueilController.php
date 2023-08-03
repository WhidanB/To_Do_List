<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class accueilPage extends AbstractController
{

    #[Route(path: '/', name: 'app_accueil')]
    public function accueil()
    {

        return $this->render('security/accueil.html.twig');
    }
}
