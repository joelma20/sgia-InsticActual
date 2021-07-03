<?php

namespace App\Controller;

use App\Repository\EstudianteRepository;
use App\Repository\ProfessorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class DashboardController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        return $this->render('dashboard/principal.html.twig');
    }


    /**
     * @Route("/painelcontrol", name="painelcontrol")
     */
    public function painelcontrol(ProfessorRepository $professorRepository, EstudianteRepository $estudianteRepository): Response
    {
        return $this->render('dashboard/painelcontrol.html.twig', [
            'CountProfe' => count($professorRepository->findAll()),
            'CountEstudante' => count($estudianteRepository->findAll()), ]);
    }
}
