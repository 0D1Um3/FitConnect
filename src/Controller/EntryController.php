<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserEntries;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\SectionsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Attribute\Route;

class EntryController extends AbstractController
{
    #[Route('/entry/{sectionId}', name: 'app_entry')]
    public function index(int $sectionId, SectionsRepository $sectionsRepository): Response
    {
        return $this->render('entry/entry.html.twig', [
            'section' => $sectionsRepository->find($sectionId),
        ]);
    }

    #[Route('/add_to_entry/{sectionId}', name: 'add_to_entry')]
    public function entry(int $sectionId, SectionsRepository $sectionRepository, EntityManagerInterface $entityManager): Response
    {

        // Найти секцию по ID
        $section = $sectionRepository->find($sectionId);
        if (!$section) {
            throw $this->createNotFoundException('Секция не найдена');
        }

        // Получение текущего пользователя
        /** @var User $user */
        $user = $this->getUser();
        if (!$user) {
            throw $this->createAccessDeniedException('Пользователь не найден');
        }

        // Создание новой записи в таблице UserEntries
        $userEntry = new UserEntries();
        $userEntry->setUser($user);
        $userEntry->setSections($section);

        $entityManager->persist($userEntry);

        // Уменьшение значения countPlaces на 1
        $currentCountPlaces = $section->getCountPlaces();
        if ($currentCountPlaces > 0) {
            $section->setCountPlaces($currentCountPlaces - 1);
        }

        // Проверка, если countPlaces достигло 0, установка softDelete в 1
        if ($section->getCountPlaces() === 0) {
            $section->setSoftDelete(1);
        }

        // Увеличение значения entries на 1 в связанной записи typesSport
        $typeSport = $section->getTypesSport();
        if ($typeSport) {
            $currentEntries = $typeSport->getEntries();
            $typeSport->setEntries($currentEntries + 1);
        }

        $entityManager->flush();

        return $this->redirectToRoute('app_profile_user_info');
    }
}
