<?php

namespace App\Controller;

use App\Entity\Reviews;
use App\Repository\ReviewsRepository;
use App\Repository\SectionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\ReviewsType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Environment;


class SectionController extends AbstractController
{
    #[Route('/section/{id}', name: 'app_section')]
    public function section(
        Environment            $twig, SectionsRepository     $sectionsRepository,
        ReviewsRepository      $reviewsRepository,
        Request                $request,
        EntityManagerInterface $entityManager,
        int                    $id
    ): Response
    {

        /*получение секции*/
        $section = $sectionsRepository->find($id);

        if (!$section) {
            throw $this->createNotFoundException('The section does not exist');
        }

        /*Создание объекта отзыва для записи данных из формы*/
        $review = new Reviews();
        $form = $this->createForm(ReviewsType::class, $review);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $review->setSections($section);
            $review->setUsers($this->getUser());

            $entityManager->persist($review);
            $entityManager->flush();

            return $this->redirectToRoute('app_section', ['id' => $id]);
        }

        /*Получение среднего рейтинга секции*/
        $reviews = $reviewsRepository->findBy([
            'sections' => $id,
            'state' => 'submitted',
        ]);

        $averageRating = 0;
        if (count($reviews) > 0) {
            $totalRating = array_reduce($reviews, function ($carry, $review) {
                return $carry + $review->getRating();
            }, 0);
            $averageRating = $totalRating / count($reviews);
        }

        /*Возврат страницы с переменными*/
        return new Response($twig->render('CatalogPage/section.html.twig', [
            'section' => $section,
            'reviews' => $reviews,
            'reviewCount' => count($reviews),
            'averageRating' => $averageRating,
            'form' => $form->createView(),
        ]));
    }
}
