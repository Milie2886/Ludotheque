<?php

namespace App\Controller;

use App\Entity\Jeu;
use App\Repository\JeuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JeuxController extends AbstractController
{
    //Route pour accéder à la page d'accueil
    #[Route('/', name: 'app_home')]
    public function index(JeuRepository $jeuRepository): Response
    {
        $jeux = $jeuRepository->findBy([], ['createdAt' => 'DESC']);
        return $this->render('jeux/index.html.twig', compact('jeux'));
    }

    //Route pour accéder à la page détail de chaque jeu, l'ID est mis en paramêtre de la route, il contiendra des chiffres obligatoirement
    #[Route('/jeux/{id<[0-9]+>}', name: 'app_jeux_show')]
    public function show(Jeu $jeu): Response
    {
        return $this->render('jeux/show.html.twig', compact('jeu'));
    }
}
