<?php

namespace App\Controller\Estructura;

use App\Entity\DisciplinaCondicionante;
use App\Form\DisciplinaCondicionanteType;
use App\Repository\DisciplinaCondicionanteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/disciplina/condicionante")
 */
class DisciplinaCondicionanteController extends AbstractController
{
    /**
     * @Route("/", name="disciplina_condicionante_index", methods={"GET"})
     */
    public function index(DisciplinaCondicionanteRepository $disciplinaCondicionanteRepository): Response
    {
        return $this->render('disciplina_condicionante/index.html.twig', [
            'disciplina_condicionantes' => $disciplinaCondicionanteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="disciplina_condicionante_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $disciplinaCondicionante = new DisciplinaCondicionante();
        $form = $this->createForm(DisciplinaCondicionanteType::class, $disciplinaCondicionante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($disciplinaCondicionante);
            $entityManager->flush();

            return $this->redirectToRoute('disciplina_condicionante_index');
        }

        return $this->render('disciplina_condicionante/new.html.twig', [
            'disciplina_condicionante' => $disciplinaCondicionante,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="disciplina_condicionante_show", methods={"GET"})
     */
    public function show(DisciplinaCondicionante $disciplinaCondicionante): Response
    {
        return $this->render('disciplina_condicionante/show.html.twig', [
            'disciplina_condicionante' => $disciplinaCondicionante,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="disciplina_condicionante_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DisciplinaCondicionante $disciplinaCondicionante): Response
    {
        $form = $this->createForm(DisciplinaCondicionanteType::class, $disciplinaCondicionante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('disciplina_condicionante_index');
        }

        return $this->render('disciplina_condicionante/edit.html.twig', [
            'disciplina_condicionante' => $disciplinaCondicionante,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="disciplina_condicionante_delete", methods={"POST"})
     */
    public function delete(Request $request, DisciplinaCondicionante $disciplinaCondicionante): Response
    {
        if ($this->isCsrfTokenValid('delete'.$disciplinaCondicionante->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($disciplinaCondicionante);
            $entityManager->flush();
        }

        return $this->redirectToRoute('disciplina_condicionante_index');
    }
}
