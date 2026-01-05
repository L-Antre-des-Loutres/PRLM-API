<?php

namespace App\Controller\Api;

use App\Entity\LevelingRate;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[Route('/api/leveling_rates', name: 'app_api_leveling_rates')]
final class LevelingRateController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $em
    ) {}

    // Get all at once
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $repository = $this->em->getRepository(LevelingRate::class);

        $rates = $repository->findAll();

        return $this->json($rates, Response::HTTP_OK);
    }

    // Get by id
    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(LevelingRate $levelingRate): JsonResponse
    {
        // Symfony handles 404 automatically due to strict typing
        return $this->json($levelingRate, Response::HTTP_OK);
    }

    // Create a leveling rate
    #[Route('', name: 'create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = $request->toArray(); // JSON sent by client

        // Basic validation
        if (empty($data['name']) || empty($data['websiteDescription'])) {
            return $this->json(['message' => 'Missing required fields'], Response::HTTP_BAD_REQUEST);
        }

        $levelingRate = new LevelingRate();
        $levelingRate->setName($data['name']);
        $levelingRate->setWebsiteDescription($data['websiteDescription']);

        $this->em->persist($levelingRate);
        $this->em->flush();

        return $this->json($levelingRate, Response::HTTP_CREATED);
    }

    // Update
    #[Route('/{id}', name: 'update', methods: ['PUT', 'PATCH'])]
    public function update(LevelingRate $levelingRate, Request $request): JsonResponse
    {
        $data = $request->toArray();

        if (isset($data['name'])) {
            $levelingRate->setName($data['name']);
        }
        if (isset($data['websiteDescription'])) {
            $levelingRate->setWebsiteDescription($data['websiteDescription']);
        }

        $this->em->flush();

        return $this->json($levelingRate, Response::HTTP_OK);
    }

    // Delete
    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete(LevelingRate $levelingRate): JsonResponse
    {
        $this->em->remove($levelingRate);
        $this->em->flush();

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}
