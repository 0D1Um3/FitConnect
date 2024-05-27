<?php

namespace App\EventSubscriber;

use App\Repository\SectionsRepository;
use App\Repository\TypeSportRepository;
use App\Repository\CityRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;

class TwigEventSubscriber implements EventSubscriberInterface
{
    private $twig;
    private $typeSportRepository;
    private $cityRepository;
    private $requestStack;

    public function __construct(
        RequestStack        $requestStack,
        Environment         $twig,
        SectionsRepository  $sectionsRepository,
        TypeSportRepository $typeSportRepository,
        CityRepository      $cityRepository)
    {
        $this->twig = $twig;
        $this->typeSportRepository = $typeSportRepository;
        $this->cityRepository = $cityRepository;
        $this->requestStack = $requestStack;
    }

    public function onControllerEvent(ControllerEvent $event): void
    {
        $currentCity = $this->requestStack->getSession()->get('current_city', 'Пенза');
        $this->twig->addGlobal('typesSport', $this->typeSportRepository->findAll());
        $this->twig->addGlobal('currentCity', $currentCity);
        $this->twig->addGlobal('cities', $this->cityRepository->findAll());

    }

    public static function getSubscribedEvents(): array
    {
        return [
            ControllerEvent::class => 'onControllerEvent',
        ];
    }
}
