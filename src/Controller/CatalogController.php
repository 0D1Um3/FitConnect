<?php

namespace App\Controller;
//Импорт классов
use App\Entity\Reviews;
use App\Entity\Sections;
use App\Repository\ArticlesRepository;
use App\Repository\CityRepository;
use App\Repository\ReviewsRepository;
use App\Repository\SectionsRepository;
use App\Repository\TypeSportRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;
class CatalogController extends AbstractController
{
    //Маршрут для страницы статьи
    #[Route('/catalog/{id}', name: 'app_catalog')]
    public function catalog(Request $request, SessionInterface $session, CityRepository $cityRepository, Environment $twig, SectionsRepository $sectionsRepository, ReviewsRepository $reviewsRepository, int $id, TypeSportRepository $typeSportRepository): Response
    {
        //Получение текущего города из сессии
        $currentCityName = $session->get('current_city', 'Пенза');
        $currentCity = $cityRepository->findOneBy(['cityName' => $currentCityName]);

        // Получение параметров поиска и фильтрации
        $search = $request->query->get('search', '');
        $priceFilter = $request->query->get('price', 'all-sections');

        // Создание QueryBuilder для поиска и фильтрации
        $qb = $sectionsRepository->createQueryBuilder('s')
            ->where('s.typesSport = :typesSport')
            ->andWhere('s.cities = :cityId')
            ->andWhere('s.softDelete = 0')
            ->setParameter('typesSport', $id)
            ->setParameter('cityId', $currentCity->getId());
        //Проверка содержания строки поиска
        if ($search) {
            $qb->andWhere('s.name LIKE :search')
                ->setParameter('search', '%' . $search . '%');
        }
        //Проверка содержания фильтров
        if ($priceFilter === 'free') {
            $qb->andWhere('s.itFree = :itFree')
                ->setParameter('itFree', true);
        }

        $sections = $qb->getQuery()->getResult();
        //Извлечение рейтинга секций
        $sectionsWithRatings = [];
        foreach ($sections as $section) {
            $reviews = $reviewsRepository->findBy([
                'sections' => $section->getId()
            ]);
            //Рассчет среднего рейтинга
            $averageRating = 0;
            if (count($reviews) > 0) {
                $totalRating = array_reduce($reviews, function ($carry, $review) {
                    return $carry + $review->getRating();
                }, 0);
                $averageRating = $totalRating / count($reviews);
            }
            //Массив секций
            $sectionsWithRatings[] = [
                'section' => $section,
                'averageRating' => $averageRating,
                'reviewCount' => count($reviews)
            ];
        }
        //Возврат шаблона
        return new Response($twig->render('CatalogPage/catalog.html.twig', [
            'sectionsWithRatings' => $sectionsWithRatings,
            'currentTypeSport' => $typeSportRepository->find($id),
            'search' => $search,
            'priceFilter' => $priceFilter,
        ]));
    }
}
