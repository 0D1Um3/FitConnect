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
use Twig\Environment;

class CatalogController extends AbstractController
{
    #[Route('/catalog/{id}', name: 'app_catalog')]
    public function catalog(Environment $twig, SectionsRepository $sectionsRepository, ReviewsRepository $reviewsRepository, int $id, TypeSportRepository $typeSportRepository): Response
    {

        // Извлекаем все рейтинги из таблицы reviews
//        $reviews = $reviewsRepository->findBy(['sections' => $id]);
//
//        // Вычисляем среднее арифметическое рейтингов
//        $totalRating = 0;
//        foreach ($reviews as $review) {
//            $totalRating += $review->getRating();
//        }
//        $averageRating = count($reviews) > 0 ? $totalRating / count($reviews) : 0;
//        ['averageRating' => $averageRating,]


        return new Response($twig->render('CatalogPage/catalog.html.twig', [
            'sections' => $sectionsRepository->findBy([
                'typesSport' => $id,
                'softDelete' => 0,
            ]),
            'currentTypeSport' => $typeSportRepository->find($id),
        ]));
    }
}
