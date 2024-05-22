<?php

namespace App\Controller;

use App\Entity\Reviews;
use App\Entity\Sections;
use App\Repository\ArticlesRepository;
use App\Repository\ReviewsRepository;
use App\Repository\SectionsRepository;
use App\Repository\TypeSportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\ReviewsType;
use App\Message\ReviewsNotification;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Environment;


class SectionController extends AbstractController
{
    #[Route('/section/{id}', name: 'app_section')]
    public function section(
        SectionsRepository $sectionsRepository,
        ReviewsRepository $reviewsRepository,
        Request $request,
        EntityManagerInterface $entityManager,
        MessageBusInterface $messageBus,
        int $id
    ): Response {
        $section = $sectionsRepository->find($id);

        if (!$section) {
            throw $this->createNotFoundException('The section does not exist');
        }

        $review = new Reviews();
        $form = $this->createForm(ReviewsType::class, $review);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Set the sections and users before saving
            $review->setSections($section);
            $review->setUsers($this->getUser());

            $entityManager->persist($review);
            $entityManager->flush();

            // Dispatch review notification message
            $messageBus->dispatch(new ReviewsNotification($review->getId()));

            return $this->redirectToRoute('app_section', ['id' => $id]);
        }

        return $this->render('CatalogPage/section.html.twig', [
            'section' => $section,
            'reviews' => $reviewsRepository->findBy(['sections' => $id]),
            'form' => $form->createView(),
        ]);
    }



    #[Route('/blog', name: 'app_blog')]
    public function blog(Environment $twig, ArticlesRepository $articlesRepository): Response
    {
        return new Response($twig->render('BlogPage/blog.html.twig'));
    }

    #[Route('/compare', name: 'app_compare')]
    public function compare(Environment $twig): Response
    {
        return new Response($twig->render('compare/compare.html.twig'));
    }
}
