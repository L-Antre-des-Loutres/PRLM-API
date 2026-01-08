<?php

namespace App\Controller;

use App\Entity\EggGroups;
use App\Form\EggGroupsType;
use App\Repository\EggGroupsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/panel/egg_groups', name: 'app_panel_egg_groups_')]
final class EggGroupsController extends AbstractController
{
    #[Route('/{id?}', name: 'index', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function index(
        Request $request,
        EntityManagerInterface $entityManager,
        EggGroupsRepository $repository,
        ?EggGroups $eggGroup = null
    ): Response
    {
        $editMode = true;

        if (!$eggGroup) {
            $editMode = false;
            $eggGroup = new EggGroups();
        }

        $form = $this->createForm(EggGroupsType::class, $eggGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($eggGroup);
            $entityManager->flush();

            $message = $editMode ? 'Egg group updated successfully!' : 'Egg group created successfully!';
            $this->addFlash('success', $message);

            return $this->redirectToRoute('app_panel_egg_groups_index');
        }

        return $this->render('egg_groups/index.html.twig', [
            'form' => $form,
            'egg_groups' => $repository->findAll(),
            'is_edit_mode' => $eggGroup->getId() !== null
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, EggGroups $eggGroup, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$eggGroup->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($eggGroup);
            $entityManager->flush();
            $this->addFlash('success', 'Egg group deleted successfully!');
        }

        return $this->redirectToRoute('app_panel_egg_groups_index');
    }
}
