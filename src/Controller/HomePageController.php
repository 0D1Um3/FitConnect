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

class HomePageController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(Environment $twig, ArticlesRepository $articlesRepository, TypeSportRepository $typeSportRepository): Response
    {
//        // Выбрать 6 случайных записей из таблицы articles
        $randomArticles = $articlesRepository->findRandom(3);
//
//        // Выбрать 3 записи из таблицы typeSport с самыми большими значениями поля entries
        $topTypeSports = $typeSportRepository->findTopByEntries(3);
//
//        ['articles'=>$randomArticles,
//            'typeSport'=>$topTypeSports,]

        return new Response($twig->render('MainPage/index.html.twig', [
            'topTypesSport' => $topTypeSports,
        ]));
    }
}
