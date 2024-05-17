<?php

namespace App\Controller;

use App\Entity\Reviews;
use App\Repository\ArticlesRepository;
use App\Repository\ReviewsRepository;
use App\Repository\SectionsRepository;
use App\Repository\TypeSportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;


class SectionController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(Environment $twig, ArticlesRepository $articlesRepository, TypeSportRepository $typeSportRepository): Response
    {
//        // Выбрать 6 случайных записей из таблицы articles
//        $randomArticles = $articlesRepository->findRandom(3);
//
//        // Выбрать 3 записи из таблицы typeSport с самыми большими значениями поля entries
//        $topTypeSports = $typeSportRepository->findTopByEntries(3);
//
//        ['articles'=>$randomArticles,
//            'typeSport'=>$topTypeSports,]

        return new Response($twig->render('MainPage/index.html.twig'));
    }

    #[Route('/catalog', name: 'catalog')]
    public function catalog(Environment $twig, SectionsRepository $sectionsRepository, ReviewsRepository $reviewsRepository):Response
    {
        // Извлекаем все рейтинги из таблицы reviews
//        $reviews = $reviewsRepository->findAll();
//
//        // Вычисляем среднее арифметическое рейтингов
//        $totalRating = 0;
//        foreach ($reviews as $review) {
//            $totalRating += $review->getRating();
//        }
//        $averageRating = count($reviews) > 0 ? $totalRating / count($reviews) : 0;
//        ['averageRating' => $averageRating,]


        return new Response($twig->render('CatalogPage/catalog.html.twig'));
    }

    #[Route('/section', name: 'section')]
    public function section(Environment $twig, SectionsRepository $sectionsRepository, ReviewsRepository $reviewsRepository):Response
    {
        return new Response($twig->render('CatalogPage/section.html.twig'));
    }

    #[Route('/blog', name: 'blog')]
    public function blog(Environment $twig, ArticlesRepository $articlesRepository)
    {
        return new Response($twig->render('BlogPage/blog.html.twig'));
    }

}
