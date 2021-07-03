<?php

namespace App\Controller\Matricula;

use App\Entity\AnoAcademico;
use App\Entity\Estudante;
use App\Form\MatriculaType;
use App\Repository\AnoAcademicoRepository;
use App\Repository\EstudianteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Matricula")
 */
class MatriculaController extends AbstractController
{
    /**
     * @Route("/", name="Matricula_index", methods={"GET"})
     */
    public function index(EstudianteRepository $estudianteRepository): Response
    {
        return $this->render('Matricula/index.html.twig', [
            'estudiantes' => $estudianteRepository->findBy(['anoAcademico'=>'1º']),
        ]);
    }

    /**
     * @Route("/new", name="Matricula_new", methods={"GET","POST"})
     */
    public function new(Request $request,
                        AnoAcademicoRepository $academicoRepository): Response
    {
        $estudiante = new Estudante();
        $form = $this->createForm(MatriculaType::class, $estudiante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($estudiante);
            $entityManager->flush();

            return $this->redirectToRoute('Matricula_index');
        }

        return $this->render('Matricula/new.html.twig', [
            'estudiante' => $estudiante,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Matricula_show", methods={"GET"})
     */
    public function show(Estudante $estudiante): Response
    {
        return $this->render('Matricula/show.html.twig', [
            'estudiante' => $estudiante,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="Matricula_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Estudante $estudiante): Response
    {
        $form = $this->createForm(MatriculaType::class, $estudiante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Matricula_index');
        }

        return $this->render('Matricula/edit.html.twig', [
            'estudiante' => $estudiante,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Matricula_delete", methods={"POST"})
     */
    public function delete(Request $request, Estudante $estudiante): Response
    {
        if ($this->isCsrfTokenValid('delete'.$estudiante->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($estudiante);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Matricula_index');
    }
}
