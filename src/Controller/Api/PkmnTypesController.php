<?php

namespace App\Controller\Api;

use App\Entity\PkmnTypes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[Route('/api/types', name: 'app_api_pkmn_types')]
final class PkmnTypesController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $em
    ) {}

    // Get all at once
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $repository = $this->em->getRepository(PkmnTypes::class);

        $types = $repository->findAll();

        return $this->json($types, Response::HTTP_OK, [], [
            'groups' => 'type:read',
            'enable_max_depth' => true
        ]);
    }

    // Get by id
    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(?PkmnTypes $pkmnTypes): JsonResponse
    {
        if (!$pkmnTypes) {
            return $this->json(['message' => 'Type not found'], 404);
        }

        return $this->json($pkmnTypes, 200, [], [
            'groups' => 'type:read',
            'enable_max_depth' => true
        ]);
    }

    // Create a type with NO RELATION to any other type
    #[Route('', name: 'create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = $request->toArray(); // JSON sent by client

        if (empty($data['name']) || empty($data['websiteDescription'])) {
            return $this->json(['message' => 'Missing required fields'], 400); // 400 Bad Request
        }

        $type = new PkmnTypes();
        $type->setName($data['name']);
        $type->setWebsiteDescription($data['websiteDescription']);

        $this->em->persist($type);
        $this->em->flush();

        return $this->json($type, Response::HTTP_CREATED, [], ['groups' => 'type:read']);
    }

    // Update
    #[Route('/{id}', name: 'update', methods: ['PUT', 'PATCH'])]
    public function update(PkmnTypes $pkmnTypes, Request $request): JsonResponse
    {
        $data = $request->toArray();

        if (isset($data['name'])) { // isset = is set
            $pkmnTypes->setName($data['name']);
        }
        if (isset($data['websiteDescription'])) {
            $pkmnTypes->setWebsiteDescription($data['websiteDescription']);
        }

        $this->em->flush();

        return $this->json($pkmnTypes, Response::HTTP_OK, [], ['groups' => 'type:read']);
    }

    // Delete
    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete(PkmnTypes $pkmnTypes): JsonResponse
    {
        $this->em->remove($pkmnTypes);
        $this->em->flush();

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}
