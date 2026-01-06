<?php

namespace App\Controller\Api;

use App\Entity\Abilities;
use App\Entity\EggGroups;
use App\Entity\LevelingRate;
use App\Entity\Pkmn;
use App\Entity\PkmnTypes;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
// N'oubliez pas use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/pkmn', name: 'app_api_pkmn')]
final class PkmnController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $em
    ) {}

    // Get all at once
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $repository = $this->em->getRepository(Pkmn::class);
        $pkmnList = $repository->findAll();

        return $this->json($pkmnList, Response::HTTP_OK, [], [
            'groups' => 'pkmn:read',
            'enable_max_depth' => true
        ]);
    }

    // Get by id
    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Pkmn $pkmn): JsonResponse
    {
        // Symfony handles 404 automatically due to strict typing
        return $this->json($pkmn, Response::HTTP_OK, [], [
            'groups' => 'pkmn:read',
            'enable_max_depth' => true
        ]);
    }

    // Create a Pkmn with relations
    #[Route('', name: 'create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = $request->toArray();

        // Validate mandatory scalar fields
        $requiredFields = ['name', 'regionalDexID', 'nationalDexID', 'formID', 'firstTypeId', 'firstAbilityId', 'levelingRateId', 'firstEggGroupId'];
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                return $this->json(['message' => "Missing required field: $field"], Response::HTTP_BAD_REQUEST);
            }
        }

        $pkmn = new Pkmn();

        // Set Scalar Data
        $pkmn->setName($data['name']);
        $pkmn->setRegionalDexID((int)$data['regionalDexID']);
        $pkmn->setNationalDexID((int)$data['nationalDexID']);
        $pkmn->setFormID((int)$data['formID']);
        $pkmn->setWebsiteDescription($data['websiteDescription'] ?? '');
        $pkmn->setCategoryName($data['categoryName'] ?? 'Unknown');
        $pkmn->setHeight((int)($data['height'] ?? 0));
        $pkmn->setWeight((int)($data['weight'] ?? 0));

        if (isset($data['stats']) && is_array($data['stats'])) {
            $pkmn->setStats($data['stats']);
        }
        if (isset($data['evYield']) && is_array($data['evYield'])) {
            $pkmn->setEvYield($data['evYield']);
        }

        $pkmn->setBaseExpYield((int)($data['baseExpYield'] ?? 0));
        $pkmn->setBaseFriendship((int)($data['baseFriendship'] ?? 70));
        $pkmn->setHatchTimeInCycle((int)($data['hatchTimeInCycle'] ?? 20));
        // Images/Files are ignored here as requested

        // Handle Mandatory Relations
        $firstType = $this->findEntity(PkmnTypes::class, $data['firstTypeId']);
        $firstAbility = $this->findEntity(Abilities::class, $data['firstAbilityId']);
        $levelingRate = $this->findEntity(LevelingRate::class, $data['levelingRateId']);
        $firstEggGroup = $this->findEntity(EggGroups::class, $data['firstEggGroupId']);

        if (!$firstType || !$firstAbility || !$levelingRate || !$firstEggGroup) {
            return $this->json(['message' => 'Invalid ID for one of the mandatory relations (Type, Ability, Rate, or EggGroup)'], Response::HTTP_BAD_REQUEST);
        }

        $pkmn->setFirstType($firstType);
        $pkmn->setFirstAbility($firstAbility);
        $pkmn->setLevelingRate($levelingRate);
        $pkmn->setFirstEggGroup($firstEggGroup);

        // Handle Optional Relations
        if (!empty($data['secondTypeId'])) {
            $pkmn->setSecondType($this->findEntity(PkmnTypes::class, $data['secondTypeId']));
        }
        if (!empty($data['secondAbilityId'])) {
            $pkmn->setSecondAbility($this->findEntity(Abilities::class, $data['secondAbilityId']));
        }
        if (!empty($data['hiddenAbilityId'])) {
            $pkmn->setHiddenAbility($this->findEntity(Abilities::class, $data['hiddenAbilityId']));
        }
        if (!empty($data['secondEggGroupId'])) {
            $pkmn->setSecondEggGroup($this->findEntity(EggGroups::class, $data['secondEggGroupId']));
        }

        $this->em->persist($pkmn);
        $this->em->flush();

        return $this->json($pkmn, Response::HTTP_CREATED, [], ['groups' => 'pkmn:read']);
    }

    // Update
    #[Route('/{id}', name: 'update', methods: ['PUT', 'PATCH'])]
    public function update(Pkmn $pkmn, Request $request): JsonResponse
    {
        $data = $request->toArray();

        // Update Scalar Data
        if (isset($data['name'])) $pkmn->setName($data['name']);
        if (isset($data['regionalDexID'])) $pkmn->setRegionalDexID((int)$data['regionalDexID']);
        if (isset($data['nationalDexID'])) $pkmn->setNationalDexID((int)$data['nationalDexID']);
        if (isset($data['formID'])) $pkmn->setFormID((int)$data['formID']);
        if (isset($data['websiteDescription'])) $pkmn->setWebsiteDescription($data['websiteDescription']);
        if (isset($data['categoryName'])) $pkmn->setCategoryName($data['categoryName']);
        if (isset($data['height'])) $pkmn->setHeight((int)$data['height']);
        if (isset($data['weight'])) $pkmn->setWeight((int)$data['weight']);

        if (isset($data['stats']) && is_array($data['stats'])) {
            $pkmn->setStats($data['stats']);
        }
        if (isset($data['evYield']) && is_array($data['evYield'])) {
            $pkmn->setEvYield($data['evYield']);
        }

        if (isset($data['baseExpYield'])) $pkmn->setBaseExpYield((int)$data['baseExpYield']);
        if (isset($data['baseFriendship'])) $pkmn->setBaseFriendship((int)$data['baseFriendship']);
        if (isset($data['hatchTimeInCycle'])) $pkmn->setHatchTimeInCycle((int)$data['hatchTimeInCycle']);

        // Update Relations : We only update if the ID is explicitly sent in the JSON.
        if (isset($data['firstTypeId'])) {
            $entity = $this->findEntity(PkmnTypes::class, $data['firstTypeId']);
            if (!$entity) {
                return $this->json(['message' => 'Invalid firstTypeId'], Response::HTTP_BAD_REQUEST);
            }
            $pkmn->setFirstType($entity);
        }
        if (array_key_exists('secondTypeId', $data)) {
            // Explicit null sent
            if ($data['secondTypeId'] === null) {
                $pkmn->setSecondType(null);
            }
            // Change relation
            else {
                $entity = $this->findEntity(PkmnTypes::class, $data['secondTypeId']);
                if (!$entity) {
                    return $this->json(['message' => 'Invalid secondTypeId'], Response::HTTP_BAD_REQUEST);
                }
                $pkmn->setSecondType($entity);
            }
        }

        if (isset($data['firstAbilityId'])) {
            $entity = $this->findEntity(Abilities::class, $data['firstAbilityId']);
            if ($entity) $pkmn->setFirstAbility($entity);
        }
        if (array_key_exists('secondAbilityId', $data)) {
            $entity = $data['secondAbilityId'] ? $this->findEntity(Abilities::class, $data['secondAbilityId']) : null;
            $pkmn->setSecondAbility($entity);
        }
        if (array_key_exists('hiddenAbilityId', $data)) {
            $entity = $data['hiddenAbilityId'] ? $this->findEntity(Abilities::class, $data['hiddenAbilityId']) : null;
            $pkmn->setHiddenAbility($entity);
        }

        if (isset($data['levelingRateId'])) {
            $entity = $this->findEntity(LevelingRate::class, $data['levelingRateId']);
            if ($entity) $pkmn->setLevelingRate($entity);
        }

        if (isset($data['firstEggGroupId'])) {
            $entity = $this->findEntity(EggGroups::class, $data['firstEggGroupId']);
            if ($entity) $pkmn->setFirstEggGroup($entity);
        }
        if (array_key_exists('secondEggGroupId', $data)) {
            $entity = $data['secondEggGroupId'] ? $this->findEntity(EggGroups::class, $data['secondEggGroupId']) : null;
            $pkmn->setSecondEggGroup($entity);
        }

        $pkmn->setUpdatedAt(new \DateTime());
        $this->em->flush();

        return $this->json($pkmn, Response::HTTP_OK, [], ['groups' => 'pkmn:read']);
    }

    // Delete
    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete(Pkmn $pkmn): JsonResponse
    {
        $this->em->remove($pkmn);
        $this->em->flush();

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Helper to find an entity by Class and ID
     */
    private function findEntity(string $class, mixed $id): ?object
    {
        if (!$id) return null;
        return $this->em->getRepository($class)->find($id);
    }
}
