<?php
// src/Controller/VideoController.php

namespace App\Controller;

use App\Entity\Video;
use App\Form\VideoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class VideoController extends AbstractController
{
    private $entityManager;

    // Injection de l'EntityManagerInterface dans le contrôleur
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/video/create', name: 'video_create')]
    public function create(Request $request): Response
    {
        $video = new Video();
        $form = $this->createForm(VideoType::class, $video);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $video->setUser($this->getUser()); // Associe l'utilisateur courant
            $video->setCreatedAt(new \DateTimeImmutable());

            // Utilisation de l'EntityManager pour persister la vidéo
            $this->entityManager->persist($video);
            $this->entityManager->flush();

            // Redirection après l'ajout de la vidéo
            return $this->redirectToRoute('video_show', ['id' => $video->getId()]);
        }

        return $this->render('video/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/video/{id}', name: 'video_show')]
    public function show(int $id): Response
    {
        // Récupération de la vidéo à partir de l'EntityManager
        $video = $this->entityManager
            ->getRepository(Video::class)
            ->find($id);

        // Vérification si la vidéo existe
        if (!$video) {
            throw $this->createNotFoundException('Vidéo non trouvée');
        }

        // Affichage de la vidéo
        return $this->render('video/show.html.twig', [
            'video' => $video,
        ]);
    }
}
