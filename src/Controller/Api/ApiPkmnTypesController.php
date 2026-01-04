<?php

namespace App\Controller\Api;

use App\Entity\PkmnTypes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/types', name: 'app_api_pkmn_types')]
final class ApiPkmnTypesController extends AbstractController
{
    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(PkmnTypes $pkmnTypes): JsonResponse
    {
        return $this->json($pkmnTypes);
    }
}
