<?php

namespace App\Controller\Estudante;

use App\Entity\Disciplina;
use App\Entity\Turma;
use App\Form\EstudanteTurmaType;
use App\Form\ImprimirListaType;
use App\Form\ListaTurmaEstudianteDisciplinaType;
use App\Repository\EstudianteRepository;
use App\Repository\TurmaRepository;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EstudanteTurmaController extends AbstractController
{
    /**
     * @Route("/EstudanteTurma", name="EstudanteTurma_index", methods={"GET"})
     */
    public function EstudanteTurma_index(TurmaRepository $turmaRepository): Response
    {
        return $this->render('EstudanteTurma/EstudanteTurma_index.html.twig', [
            'turmas' => $turmaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/EstudanteTurma/Estudantes/{idT}", name="EstudanteTurma_Estudantes", methods={"GET"})
     */
    public function EstudanteTurma_Estudantes(TurmaRepository $turmaRepository,
                                              Turma $idT): Response
    {
        $turma = $turmaRepository->findOneBy(['id'=>$idT->getId()]);
        return $this->render('EstudanteTurma/EstudanteTurma_Estudantes.html.twig', [
            'turma' => $turma,

        ]);
    }

    /**
     * @Route("/EstudanteTurma/Estudantes/{id}/edit", name="EstudanteTurma_Estudantes_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Turma $turma): Response
    {
        $form = $this->createForm(EstudanteTurmaType::class, $turma);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('EstudanteTurma_Estudantes',['idT' =>$turma->getId()]);
        }

        return $this->render('EstudanteTurma/edit.html.twig', [
            'turma' => $turma,
            'form' => $form->createView(),
        ]);
    }



}