<?php

namespace App\Controller;

use App\Entity\GameOrRegion;
use App\Form\GameOrRegionType;
use App\Repository\GameOrRegionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/panel/game_or_region', name: 'app_panel_game_or_region_')]
final class GameOrRegionController extends AbstractController
{
    #[Route('/{id?}', name: 'index', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function index(
        Request $request,
        EntityManagerInterface $entityManager,
        GameOrRegionRepository $repository,
        ?GameOrRegion $gameOrRegion = null
    ): Response
    {
        $editMode = true;

        if (!$gameOrRegion) {
            $editMode = false;
            $gameOrRegion = new GameOrRegion();
        }

        $form = $this->createForm(GameOrRegionType::class, $gameOrRegion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($gameOrRegion);
            $entityManager->flush();

            $message = $editMode ? 'Updated successfully!' : 'Created successfully!';
            $this->addFlash('success', $message);

            return $this->redirectToRoute('app_panel_game_or_region_index');
        }

        return $this->render('game_or_region/index.html.twig', [
            'form' => $form,
            'game_or_regions' => $repository->findAll(),
            'is_edit_mode' => $gameOrRegion->getId() !== null
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, GameOrRegion $gameOrRegion, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gameOrRegion->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($gameOrRegion);
            $entityManager->flush();
            $this->addFlash('success', 'Deleted successfully!');
        }

        return $this->redirectToRoute('app_panel_game_or_region_index');
    }
}
