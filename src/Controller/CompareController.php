<?php

namespace App\Controller;
use App\Entity\CompareSection;
use App\Entity\User;
use App\Repository\SectionsRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CompareSectionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class CompareController extends AbstractController
{
    #[Route('/add-to-compare/{sectionId}', name: 'add_to_compare')]
    public function addToCompare(int $sectionId, Request $request, EntityManagerInterface $entityManager, SectionsRepository $sectionRepository, CompareSectionRepository $compareSectionRepository): Response
    {

        // Найти секцию по ID
        $section = $sectionRepository->find($sectionId);
        if (!$section) {
            throw $this->createNotFoundException('Секция не найдена');
        }

        // Получить текущего пользователя
        /** @var User $user */
        $user = $this->getUser();
        if (!$user) {
            throw $this->createAccessDeniedException('Пользователь не найден');
        }

        // Проверить, существует ли запись для этого пользователя и секции
        $existingCompareSection = $compareSectionRepository->findOneBy([
            'user' => $user,
            'sections' => $section,
        ]);

        if (!$existingCompareSection) {
            // Создать новую запись в CompareSection
            $compareSection = new CompareSection();
            $compareSection->setUser($user);
            $compareSection->setSections($section);

            // Сохранить запись
            $entityManager->persist($compareSection);
        } else {
            // Удалить существующую запись из CompareSection
            $entityManager->remove($existingCompareSection);
        }

        $entityManager->flush();

        // Получить URL для редиректа
        $redirectUrl = $request->query->get('redirect', $this->generateUrl('app_section', ['id' => $sectionId]));

        return $this->redirect($redirectUrl);
    }

    #[Route('/compare', name: 'app_compare')]
    public function compare(Environment $twig, Request $request, EntityManagerInterface $entityManager, CompareSectionRepository $compareSectionRepository): Response
    {
        // Получить текущего пользователя
        $user = $this->getUser();

        // Найти все CompareSection для текущего пользователя
        $compareSections = $compareSectionRepository->findBy(['user' => $user]);

        return new Response($twig->render('compare/compare.html.twig', [
            'compareSections' => $compareSections,
        ]));
    }
}
