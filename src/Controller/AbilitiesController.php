<?php

namespace App\Controller;

use App\Entity\Abilities;
use App\Form\AbilitiesType;
use App\Repository\AbilitiesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/panel/abilities', name: 'app_panel_abilities_')]
final class AbilitiesController extends AbstractController
{
    #[Route('/{id?}', name: 'index', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function index(
        Request $request,
        EntityManagerInterface $entityManager,
        AbilitiesRepository $repository,
        ?Abilities $ability = null
    ): Response
    {
        $editMode = true;

        if (!$ability) {
            $editMode = false;
            $ability = new Abilities();
        }

        $form = $this->createForm(AbilitiesType::class, $ability);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ability);
            $entityManager->flush();

            $message = $editMode ? 'Ability updated successfully!' : 'Ability created successfully!';
            $this->addFlash('success', $message);

            return $this->redirectToRoute('app_panel_abilities_index');
        }

        return $this->render('abilities/index.html.twig', [
            'form' => $form,
            'abilities' => $repository->findAll(),
            'is_edit_mode' => $ability->getId() !== null
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Abilities $ability, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ability->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($ability);
            $entityManager->flush();
            $this->addFlash('success', 'Ability deleted successfully!');
        }

        return $this->redirectToRoute('app_panel_abilities_index');
    }
}
