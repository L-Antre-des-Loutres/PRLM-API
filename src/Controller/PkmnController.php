<?php

namespace App\Controller;

use App\Entity\Pkmn;
use App\Form\PkmnAndMovesetType;
use App\Repository\PkmnRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/panel/pkmn', name: 'app_panel_pkmn_')]
final class PkmnController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(PkmnRepository $pkmnRepository): Response
    {
        return $this->render('pkmn/index.html.twig', [
            'pkmn_list' => $pkmnRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $pkmn = new Pkmn();
        $form = $this->createForm(PkmnAndMovesetType::class, $pkmn);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($pkmn);
            $entityManager->flush();

            $this->addFlash('success', 'Pokémon created successfully!');

            return $this->redirectToRoute('app_panel_pkmn_index');
        }

        return $this->render('pkmn/form.html.twig', [
            'pkmn' => $pkmn,
            'form' => $form,
            'is_edit_mode' => false
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pkmn $pkmn, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PkmnAndMovesetType::class, $pkmn);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Pokémon updated successfully!');

            return $this->redirectToRoute('app_panel_pkmn_index');
        }

        return $this->render('pkmn/form.html.twig', [
            'pkmn' => $pkmn,
            'form' => $form,
            'is_edit_mode' => true
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Pkmn $pkmn, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pkmn->id, $request->getPayload()->get('_token'))) {
            $entityManager->remove($pkmn);
            $entityManager->flush();
            $this->addFlash('success', 'Pokémon deleted successfully!');
        }

        return $this->redirectToRoute('app_panel_pkmn_index');
    }
}
