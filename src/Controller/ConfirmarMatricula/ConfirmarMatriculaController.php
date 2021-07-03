<?php

namespace App\Controller\ConfirmarMatricula;

use App\Entity\Estudante;
use App\Form\ConfirmarMatriculaType;
use App\Form\MatriculaType;
use App\Repository\EstudianteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Confirmar")
 */
class ConfirmarMatriculaController extends AbstractController
{
    /**
     * @Route("/", name="Confirmar_index", methods={"GET"})
     */
    public function index(EstudianteRepository $estudianteRepository): Response
    {
        return $this->render('ConfirmarMatricula/index.html.twig', [
            'estudiantes' => $estudianteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="Confirmar_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $estudiante = new Estudante();
        $form = $this->createForm(ConfirmarMatriculaType::class, $estudiante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($estudiante);
            $entityManager->flush();

            return $this->redirectToRoute('Confirmar_index');
        }

        return $this->render('ConfirmarMatricula/new.html.twig', [
            'estudiante' => $estudiante,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Confirmar_show", methods={"GET"})
     */
    public function show(Estudante $estudiante): Response
    {
        return $this->render('ConfirmarMatricula/show.html.twig', [
            'estudiante' => $estudiante,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="Confirmar_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Estudante $estudiante): Response
    {
        $form = $this->createForm(ConfirmarMatriculaType::class, $estudiante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Confirmar_index');
        }

        return $this->render('ConfirmarMatricula/edit.html.twig', [
            'estudiante' => $estudiante,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Confirmar_delete", methods={"POST"})
     */
    public function delete(Request $request, Estudante $estudiante): Response
    {
        if ($this->isCsrfTokenValid('delete'.$estudiante->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($estudiante);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Confirmar_index');
    }
}
