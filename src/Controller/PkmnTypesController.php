<?php

namespace App\Controller;

use App\Entity\PkmnTypes;
use App\Form\PkmnTypesType;
use App\Repository\PkmnTypesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/panel/pkmn_types', name: 'app_panel_pkmn_types_')]
final class PkmnTypesController extends AbstractController
{
    #[Route('/{id?}', name: 'index', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function index(
        Request $request,
        EntityManagerInterface $entityManager,
        PkmnTypesRepository $repository,
        ?PkmnTypes $pkmnType = null
    ): Response
    {
        $editMode = true;

        if (!$pkmnType) {
            $editMode = false;
            $pkmnType = new PkmnTypes();
        }

        $form = $this->createForm(PkmnTypesType::class, $pkmnType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($pkmnType);
            $entityManager->flush();

            $message = $editMode ? 'Type updated successfully!' : 'Type created successfully!';
            $this->addFlash('success', $message);

            return $this->redirectToRoute('app_panel_pkmn_types_index');
        }

        return $this->render('pkmn_types/index.html.twig', [
            'form' => $form,
            'pkmn_types' => $repository->findAll(),
            'is_edit_mode' => $pkmnType->getId() !== null
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, PkmnTypes $pkmnType, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pkmnType->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($pkmnType);
            $entityManager->flush();
            $this->addFlash('success', 'Type deleted successfully!');
        }

        return $this->redirectToRoute('app_panel_pkmn_types_index');
    }
}
