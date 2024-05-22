<?php

namespace App\Controller\Admin;

use App\Entity\Articles;
use App\Entity\Images;
use App\Entity\Sections;
use App\Entity\Reviews;
use App\Entity\User;
use App\Entity\City;
use App\Entity\TypeSport;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url =  $routeBuilder->setController(SectionsCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('FitConnect');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Вернуться на сайт', 'fas fa-home', 'app_homepage');
        yield MenuItem::linkToCrud('Секции', 'fas fa-map-marker-alt', Sections::class);
        yield MenuItem::linkToCrud('Отзывы', 'fas fa-reviews', Reviews::class);
        yield MenuItem::linkToCrud('Пользователи', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Города', 'fas fa-city', City::class);
        yield MenuItem::linkToCrud('Виды спорта', 'fas fa-types-sport', TypeSport::class);
        yield MenuItem::linkToCrud('Статьи', 'fas fa-articles', Articles::class);
        yield MenuItem::linkToCrud('Изображения', 'fas fa-images', Images::class);
    }
}
