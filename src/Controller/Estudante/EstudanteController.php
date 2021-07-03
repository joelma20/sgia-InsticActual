<?php

namespace App\Controller\Estudante;

use App\Entity\AnoAcademico;
use App\Entity\Estudante;
use App\Form\EstudantesType;
use App\Form\MatriculaType;
use App\Repository\AnoAcademicoRepository;
use App\Repository\EstudianteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Estudante")
 */
class EstudanteController extends AbstractController
{
    /**
     * @Route("/", name="Estudante_index", methods={"GET"})
     */
    public function index(EstudianteRepository $estudianteRepository): Response
    {
        return $this->render('Estudantes/index.html.twig', [
            'estudiantes' => $estudianteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="Estudante_new", methods={"GET","POST"})
     */
    public function new(Request $request,
                        AnoAcademicoRepository $academicoRepository): Response
    {
        $estudiante = new Estudante();
        $form = $this->createForm(EstudantesType::class, $estudiante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($estudiante);
            $entityManager->flush();

            return $this->redirectToRoute('Estudante_index');
        }

        return $this->render('Estudantes/new.html.twig', [
            'estudiante' => $estudiante,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Estudante_show", methods={"GET"})
     */
    public function show(Estudante $estudiante): Response
    {
        return $this->render('Estudantes/show.html.twig', [
            'estudiante' => $estudiante,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="Estudante_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Estudante $estudiante): Response
    {
        $form = $this->createForm(EstudantesType::class, $estudiante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Estudante_index');
        }

        return $this->render('Estudantes/edit.html.twig', [
            'estudiante' => $estudiante,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Estudante_delete", methods={"POST"})
     */
    public function delete(Request $request, Estudante $estudiante): Response
    {
        if ($this->isCsrfTokenValid('delete'.$estudiante->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($estudiante);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Estudante_index');
    }
}
