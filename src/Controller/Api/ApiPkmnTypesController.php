<?php

namespace App\Controller\Api;

use App\Entity\PkmnTypes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[Route('/api/types', name: 'app_api_pkmn_types')]
final class ApiPkmnTypesController extends AbstractController
{
    // Get
    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(?PkmnTypes $pkmnTypes): JsonResponse
    {
        if (!$pkmnTypes) {
            return $this->json(['message' => 'Not found'], 404);
        }

        return $this->json($pkmnTypes, 200, [], [
            'groups' => 'type:read',
            'enable_max_depth' => true
        ]);
    }

    // Create a type with NO RELATION to any other type
    #[Route('', name: 'create', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = $request->toArray(); // JSON sent by client

        $type = new PkmnTypes();
        $type->setName($data['name']);
        $type->setWebsiteDescription($data['websiteDescription']);

        $em->persist($type);
        $em->flush();

        return $this->json($type, Response::HTTP_CREATED, [], ['groups' => 'type:read']);
    }

    // Update
    #[Route('/{id}', name: 'update', methods: ['PUT', 'PATCH'])]
    public function update(PkmnTypes $pkmnTypes, Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = $request->toArray();

        if (isset($data['name'])) { // isset = is set
            $pkmnTypes->setName($data['name']);
        }
        if (isset($data['websiteDescription'])) {
            $pkmnTypes->setWebsiteDescription($data['websiteDescription']);
        }

        $em->flush();

        return $this->json($pkmnTypes, Response::HTTP_OK, [], ['groups' => 'type:read']);
    }

    // Delete
    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete(PkmnTypes $pkmnTypes, EntityManagerInterface $em): JsonResponse
    {
        $em->remove($pkmnTypes);
        $em->flush();

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}
