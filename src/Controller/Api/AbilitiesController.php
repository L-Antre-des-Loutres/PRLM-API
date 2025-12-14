<?php

namespace App\Controller\Api;

use App\Entity\Abilities;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/abilities', name: 'app_abilities')]
final class AbilitiesController extends AbstractController
{
    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Abilities $abilities): JsonResponse
    {
        return $this->json($abilities);
    }
}
