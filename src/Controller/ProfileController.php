<?php
// src/Controller/ProfileController.php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfileFormType;
use App\Repository\UserEntriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class ProfileController extends AbstractController
{
    #[Route('/profile/user_info', name: 'app_profile_user_info')]
    public function userInfo(Request $request, EntityManagerInterface $entityManager, Security $security, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        // Получаем текущего пользователя
        $user = $security->getUser();

        // Проверяем, что пользователь не null и реализует интерфейс PasswordAuthenticatedUserInterface
        if (!$user instanceof PasswordAuthenticatedUserInterface) {
            throw $this->createAccessDeniedException('Доступ запрещен');
        }

        // Создаем форму и передаем в неё текущего пользователя
        $form = $this->createForm(ProfileFormType::class, $user);
        $form->handleRequest($request);

        // Обрабатываем форму
        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form->get('password')->getData();
            if ($plainPassword) {
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $plainPassword
                    )
                );
            }

            // Сохраняем изменения в базе данных
            $entityManager->flush();

            // Обновляем данные в сессии (если нужно)
            $this->addFlash('success', 'Ваши данные успешно обновлены.');

            return $this->redirectToRoute('app_profile_user_info');
        }

        return $this->render('profile/profile.html.twig', [
            'profileForm' => $form->createView(),
        ]);
    }

    #[Route('/profile/user_entries', name: 'app_user_entries')]
    public function userEntries(UserEntriesRepository $userEntriesRepository): Response
    {
        // Получение текущего пользователя
        /** @var User $user */
        $user = $this->getUser();
        if (!$user) {
            throw $this->createAccessDeniedException('Пользователь не найден');
        }

        // Получение записей текущего пользователя
        $entries = $userEntriesRepository->findBy(['user' => $user]);

        return $this->render('profile/userEntries.html.twig', [
            'entries' => $entries,
        ]);
    }
}
