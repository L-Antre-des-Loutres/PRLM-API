<?php

namespace App\Controller\Api;

use App\Entity\EggGroups;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[Route('/api/egg_groups', name: 'app_api_egg_groups')]
final class EggGroupsController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $em
    ) {}

    // Get all at once
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $repository = $this->em->getRepository(EggGroups::class);

        $eggGroups = $repository->findAll();

        return $this->json($eggGroups, Response::HTTP_OK);
    }

    // Get by id
    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(EggGroups $eggGroups): JsonResponse
    {
        // Symfony handles 404 automatically due to strict typing (EggGroups $eggGroups)
        return $this->json($eggGroups, Response::HTTP_OK);
    }

    // Create an egg group
    #[Route('', name: 'create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = $request->toArray(); // JSON sent by client

        // Basic validation
        if (empty($data['name']) || empty($data['websiteDescription'])) {
            return $this->json(['message' => 'Missing required fields'], Response::HTTP_BAD_REQUEST);
        }

        $eggGroup = new EggGroups();
        $eggGroup->setName($data['name']);
        $eggGroup->setWebsiteDescription($data['websiteDescription']);

        $this->em->persist($eggGroup);
        $this->em->flush();

        return $this->json($eggGroup, Response::HTTP_CREATED);
    }

    // Update
    #[Route('/{id}', name: 'update', methods: ['PUT', 'PATCH'])]
    public function update(EggGroups $eggGroups, Request $request): JsonResponse
    {
        $data = $request->toArray();

        if (isset($data['name'])) {
            $eggGroups->setName($data['name']);
        }
        if (isset($data['websiteDescription'])) {
            $eggGroups->setWebsiteDescription($data['websiteDescription']);
        }

        $this->em->flush();

        return $this->json($eggGroups, Response::HTTP_OK);
    }

    // Delete
    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete(EggGroups $eggGroups): JsonResponse
    {
        $this->em->remove($eggGroups);
        $this->em->flush();

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}
