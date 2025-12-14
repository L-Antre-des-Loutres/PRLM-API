<?php

namespace App\Controller\Api;

use App\Entity\Abilities;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/abilities', name: 'app_abilities_')]
final class AbilitiesController extends AbstractController
{
    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Abilities $ability): JsonResponse
    {
        return $this->json($ability);
    }
}
