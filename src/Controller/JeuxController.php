<?php

namespace App\Controller;

use App\Entity\Jeu;
use App\Form\JeuType;
use App\Repository\JeuRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//Controller pour gérer l'ajout, l'édition, la suppression des jeux
class JeuxController extends AbstractController
{
    //Route pour accéder à la page d'accueil
    #[Route('/', name: 'app_home', methods: "GET")]
    public function index(JeuRepository $jeuRepository): Response
    {
        $jeux = $jeuRepository->findBy([], ['createdAt' => 'DESC']);
        return $this->render('jeux/index.html.twig', compact('jeux'));
    }

    //Route pour accéder à la page détail de chaque jeu, l'ID est mis en paramêtre de la route, il contiendra des chiffres obligatoirement
    #[Route('/jeux/{id<[0-9]+>}', name: 'app_jeux_show', methods: "GET")]
    public function show(Jeu $jeu): Response
    {
        return $this->render('jeux/show.html.twig', compact('jeu'));
    }

    //Route pour ajouter un jeu
    #[Route('/jeux/create', name: 'app_jeux_create', methods: ["GET", "POST"])]
    public function create(Request $request , EntityManagerInterface $em, UserRepository $userRepo): Response
    {
        
        $jeu = new Jeu;
        $form = $this->createForm(JeuType::class, $jeu);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $jeu->setUser($this->getUser());
            $em->persist($jeu);
            $em->flush();

            $this->addFlash('success', 'Jeu ajouté avec succès!');

            return $this->redirectToRoute('app_home');
        }

        return $this->render('jeux/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    //Route pour modifier un jeu
    #[Route('/jeux/{id<[0-9]+>}/edit', name: 'app_jeux_edit', methods: ["GET", "POST"])]
    public function edit(Request $request , EntityManagerInterface $em, Jeu $jeu): Response
    {
        $form = $this->createForm(JeuType::class, $jeu);

        $form->handleRequest($request);

        
        if ($form->isSubmitted() && $form->isValid()){
            $em->flush();

            $this->addFlash('info', 'Jeu modifié avec succès!');
            
            return $this->redirectToRoute('app_home');
        }

        return $this->render('jeux/edit.html.twig', [
            'jeu' => $jeu,
            'form' => $form->createView()
        ]);
    }

     //Route pour supprimer un jeu
    #[Route('/jeux/{id<[0-9]+>}/delete', name: 'app_jeux_delete')]
    public function delete(Request $request, Jeu $jeu, EntityManagerInterface $em): Response
    {
    if ($this->isCsrfTokenValid('jeu_deletion_' . $jeu->getId(), $request->request->get('csrf_token'))) {
        
        $em->remove($jeu);
        $em->flush();

        $this->addFlash('warning', 'Jeu supprimé avec succès!');
    }

    return $this->redirectToRoute('app_home');
    }
    #[Route('/phpinfo', name: 'phpinfo')]
    public function phpinfo()
    {
        return phpinfo();
    }
}
