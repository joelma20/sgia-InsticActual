<?php

namespace App\Controller\Estructura;

use App\Entity\AnoAcademico;
use App\Form\AnoAcademicoType;
use App\Repository\AnoAcademicoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ano/academico")
 */
class AnoAcademicoController extends AbstractController
{
    /**
     * @Route("/", name="ano_academico_index", methods={"GET"})
     */
    public function index(AnoAcademicoRepository $anoAcademicoRepository): Response
    {
        return $this->render('ano_academico/index.html.twig', [
            'ano_academicos' => $anoAcademicoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ano_academico_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $anoAcademico = new AnoAcademico();
        $form = $this->createForm(AnoAcademicoType::class, $anoAcademico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($anoAcademico);
            $entityManager->flush();

            return $this->redirectToRoute('ano_academico_index');
        }

        return $this->render('ano_academico/new.html.twig', [
            'ano_academico' => $anoAcademico,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ano_academico_show", methods={"GET"})
     */
    public function show(AnoAcademico $anoAcademico): Response
    {
        return $this->render('ano_academico/show.html.twig', [
            'ano_academico' => $anoAcademico,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ano_academico_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AnoAcademico $anoAcademico): Response
    {
        $form = $this->createForm(AnoAcademicoType::class, $anoAcademico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ano_academico_index');
        }

        return $this->render('ano_academico/edit.html.twig', [
            'ano_academico' => $anoAcademico,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ano_academico_delete", methods={"POST"})
     */
    public function delete(Request $request, AnoAcademico $anoAcademico): Response
    {
        if ($this->isCsrfTokenValid('delete'.$anoAcademico->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($anoAcademico);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ano_academico_index');
    }
}
