<?php

namespace App\Controller\Professor;

use App\Entity\DisciplinaProfessoreTurma;
use App\Form\DisciplinaProfessoreTurmaType;
use App\Repository\DisciplinaProfessoreTurmaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/DisciplinaProfessoreTurma")
 */
class DisciplinaProfessoreTurmaController extends AbstractController
{
    /**
     * @Route("/", name="disciplina_professore_turma_index", methods={"GET"})
     */
    public function index(DisciplinaProfessoreTurmaRepository $disciplinaProfessoreTurmaRepository): Response
    {
        return $this->render('disciplina_professore_turma/index.html.twig', [
            'disciplina_professore_turmas' => $disciplinaProfessoreTurmaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="disciplina_professore_turma_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $disciplinaProfessoreTurma = new DisciplinaProfessoreTurma();
        $form = $this->createForm(DisciplinaProfessoreTurmaType::class, $disciplinaProfessoreTurma);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($disciplinaProfessoreTurma);
            $entityManager->flush();

            return $this->redirectToRoute('disciplina_professore_turma_index');
        }

        return $this->render('disciplina_professore_turma/new.html.twig', [
            'disciplina_professore_turma' => $disciplinaProfessoreTurma,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="disciplina_professore_turma_show", methods={"GET"})
     */
    public function show(DisciplinaProfessoreTurma $disciplinaProfessoreTurma): Response
    {
        return $this->render('disciplina_professore_turma/show.html.twig', [
            'disciplina_professore_turma' => $disciplinaProfessoreTurma,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="disciplina_professore_turma_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DisciplinaProfessoreTurma $disciplinaProfessoreTurma): Response
    {
        $form = $this->createForm(DisciplinaProfessoreTurmaType::class, $disciplinaProfessoreTurma);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('disciplina_professore_turma_index');
        }

        return $this->render('disciplina_professore_turma/edit.html.twig', [
            'disciplina_professore_turma' => $disciplinaProfessoreTurma,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="disciplina_professore_turma_delete", methods={"POST"})
     */
    public function delete(Request $request, DisciplinaProfessoreTurma $disciplinaProfessoreTurma): Response
    {
        if ($this->isCsrfTokenValid('delete'.$disciplinaProfessoreTurma->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($disciplinaProfessoreTurma);
            $entityManager->flush();
        }

        return $this->redirectToRoute('disciplina_professore_turma_index');
    }
}
