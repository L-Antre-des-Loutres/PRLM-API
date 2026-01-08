<?php

namespace App\Controller;

use App\Entity\LevelingRate;
use App\Form\LevelingRateType;
use App\Repository\LevelingRateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/panel/leveling_rate', name: 'app_panel_leveling_rate_')]
final class LevelingRateController extends AbstractController
{
    #[Route('/{id?}', name: 'index', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function index(
        Request $request,
        EntityManagerInterface $entityManager,
        LevelingRateRepository $repository,
        ?LevelingRate $levelingRate = null
    ): Response
    {
        $editMode = true;

        if (!$levelingRate) {
            $editMode = false;
            $levelingRate = new LevelingRate();
        }

        $form = $this->createForm(LevelingRateType::class, $levelingRate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($levelingRate);
            $entityManager->flush();

            $message = $editMode ? 'Leveling Rate updated successfully!' : 'Leveling Rate created successfully!';
            $this->addFlash('success', $message);

            return $this->redirectToRoute('app_panel_leveling_rate_index');
        }

        return $this->render('leveling_rate/index.html.twig', [
            'form' => $form,
            'leveling_rates' => $repository->findAll(),
            'is_edit_mode' => $levelingRate->getId() !== null
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, LevelingRate $levelingRate, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$levelingRate->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($levelingRate);
            $entityManager->flush();
            $this->addFlash('success', 'Leveling Rate deleted successfully!');
        }

        return $this->redirectToRoute('app_panel_leveling_rate_index');
    }
}
