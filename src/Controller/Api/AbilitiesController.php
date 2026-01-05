<?php

namespace App\Controller\Api;

use App\Entity\Abilities;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[Route('/api/abilities', name: 'app_api_abilities')]
final class AbilitiesController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $em
    ) {}

    // Get all at once
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $repository = $this->em->getRepository(Abilities::class);

        $abilities = $repository->findAll();

        return $this->json($abilities, Response::HTTP_OK);
    }

    // Get by id
    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Abilities $abilities): JsonResponse
    {
        // Symfony handles 404 automatically due to strict typing (Abilities $abilities)
        return $this->json($abilities, Response::HTTP_OK);
    }

    // Create an ability
    #[Route('', name: 'create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = $request->toArray(); // JSON sent by client

        // Basic validation
        if (empty($data['name']) || empty($data['inGameDescription']) || empty($data['websiteDescription'])) {
            return $this->json(['message' => 'Missing required fields'], Response::HTTP_BAD_REQUEST);
        }

        $ability = new Abilities();
        $ability->setName($data['name']);
        $ability->setInGameDescription($data['inGameDescription']);
        $ability->setWebsiteDescription($data['websiteDescription']);

        $this->em->persist($ability);
        $this->em->flush();

        return $this->json($ability, Response::HTTP_CREATED);
    }

    // Update
    #[Route('/{id}', name: 'update', methods: ['PUT', 'PATCH'])]
    public function update(Abilities $abilities, Request $request): JsonResponse
    {
        $data = $request->toArray();

        if (isset($data['name'])) {
            $abilities->setName($data['name']);
        }
        if (isset($data['inGameDescription'])) {
            $abilities->setInGameDescription($data['inGameDescription']);
        }
        if (isset($data['websiteDescription'])) {
            $abilities->setWebsiteDescription($data['websiteDescription']);
        }

        $this->em->flush();

        return $this->json($abilities, Response::HTTP_OK);
    }

    // Delete
    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete(Abilities $abilities): JsonResponse
    {
        $this->em->remove($abilities);
        $this->em->flush();

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}
