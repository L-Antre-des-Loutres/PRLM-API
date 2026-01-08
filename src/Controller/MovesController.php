<?php

namespace App\Controller;

use App\Entity\Moves;
use App\Form\MovesType;
use App\Repository\MovesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/panel/moves', name: 'app_panel_moves_')]
final class MovesController extends AbstractController
{
    #[Route('/{id?}', name: 'index', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function index(
        Request $request,
        EntityManagerInterface $entityManager,
        MovesRepository $repository,
        ?Moves $move = null
    ): Response
    {
        $editMode = true;

        if (!$move) {
            $editMode = false;
            $move = new Moves();
        }

        $form = $this->createForm(MovesType::class, $move);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($move);
            $entityManager->flush();

            $message = $editMode ? 'Move updated successfully!' : 'Move created successfully!';
            $this->addFlash('success', $message);

            return $this->redirectToRoute('app_panel_moves_index');
        }

        return $this->render('moves/index.html.twig', [
            'form' => $form,
            'moves' => $repository->findAll(),
            'is_edit_mode' => $move->getId() !== null
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Moves $move, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$move->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($move);
            $entityManager->flush();
            $this->addFlash('success', 'Move deleted successfully!');
        }

        return $this->redirectToRoute('app_panel_moves_index');
    }
}
