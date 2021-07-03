<?php

namespace App\Controller\Estructura;

use App\Entity\Disciplina;
use App\Form\DicsiplinaType;
use App\Repository\DicsiplinaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dicsiplina")
 */
class DicsiplinaController extends AbstractController
{
    /**
     * @Route("/", name="dicsiplina_index", methods={"GET"})
     */
    public function index(DicsiplinaRepository $dicsiplinaRepository): Response
    {
        return $this->render('dicsiplina/index.html.twig', [
            'dicsiplinas' => $dicsiplinaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="dicsiplina_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $dicsiplina = new Disciplina();
        $form = $this->createForm(DicsiplinaType::class, $dicsiplina);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dicsiplina);
            $entityManager->flush();

            return $this->redirectToRoute('dicsiplina_index');
        }

        return $this->render('dicsiplina/new.html.twig', [
            'dicsiplina' => $dicsiplina,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dicsiplina_show", methods={"GET"})
     */
    public function show(Disciplina $dicsiplina): Response
    {
        return $this->render('dicsiplina/show.html.twig', [
            'dicsiplina' => $dicsiplina,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="dicsiplina_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Disciplina $dicsiplina): Response
    {
        $form = $this->createForm(DicsiplinaType::class, $dicsiplina);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dicsiplina_index');
        }

        return $this->render('dicsiplina/edit.html.twig', [
            'dicsiplina' => $dicsiplina,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dicsiplina_delete", methods={"POST"})
     */
    public function delete(Request $request, Disciplina $dicsiplina): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dicsiplina->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dicsiplina);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dicsiplina_index');
    }
}
