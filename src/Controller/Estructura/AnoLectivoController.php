<?php

namespace App\Controller\Estructura;

use App\Entity\AnoLectivo;
use App\Form\AnoLectivoType;
use App\Repository\AnoLectivoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ano/lectivo")
 */
class AnoLectivoController extends AbstractController
{
    /**
     * @Route("/", name="ano_lectivo_index", methods={"GET"})
     */
    public function index(AnoLectivoRepository $anoLectivoRepository): Response
    {
        return $this->render('ano_lectivo/index.html.twig', [
            'ano_lectivos' => $anoLectivoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ano_lectivo_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $anoLectivo = new AnoLectivo();
        $form = $this->createForm(AnoLectivoType::class, $anoLectivo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($anoLectivo);
            $entityManager->flush();

            return $this->redirectToRoute('ano_lectivo_index');
        }

        return $this->render('ano_lectivo/new.html.twig', [
            'ano_lectivo' => $anoLectivo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ano_lectivo_show", methods={"GET"})
     */
    public function show(AnoLectivo $anoLectivo): Response
    {
        return $this->render('ano_lectivo/show.html.twig', [
            'ano_lectivo' => $anoLectivo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ano_lectivo_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AnoLectivo $anoLectivo): Response
    {
        $form = $this->createForm(AnoLectivoType::class, $anoLectivo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ano_lectivo_index');
        }

        return $this->render('ano_lectivo/edit.html.twig', [
            'ano_lectivo' => $anoLectivo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ano_lectivo_delete", methods={"POST"})
     */
    public function delete(Request $request, AnoLectivo $anoLectivo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$anoLectivo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($anoLectivo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ano_lectivo_index');
    }
}
