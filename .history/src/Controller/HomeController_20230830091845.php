<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ReviewRepository $reviewRepository, PaginatorInterface $paginator, Request $request,): Response
    {
        $data = $reviewRepository->findAll();

        $pagination = $paginator->paginate(
        $data, // Requête contenant les données à paginer

        $request->query->getInt('page', 1), // Numéro de la page en cours, 1 par défaut
        4 // Nombre de résultats par page
    );

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'reviews' => $pagination
        ]);
    }
}
