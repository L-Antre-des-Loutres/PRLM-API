<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AbilitiesController extends AbstractController
{
    #[Route('/abilities', name: 'app_abilities')]
    public function index(): Response
    {
        return $this->render('abilities/index.html.twig', [
            'controller_name' => 'AbilitiesController',
        ]);
    }
}
