<?php

namespace App\EventSubscriber;

use App\Repository\SectionsRepository;
use App\Repository\TypeSportRepository;
use App\Repository\CityRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;

class TwigEventSubscriber implements EventSubscriberInterface
{
    private $twig;
    private $sectionsRepository;

    private $typeSportRepository;

    private $cityRepository;

    public function __construct(Environment $twig, SectionsRepository $sectionsRepository,TypeSportRepository $typeSportRepository, CityRepository $cityRepository){
        $this->twig = $twig;
        $this->sectionsRepository = $sectionsRepository;
        $this->typeSportRepository = $typeSportRepository;
        $this->cityRepository = $cityRepository;
    }
    public function onControllerEvent(ControllerEvent $event): void
    {
        $this->twig->addGlobal('typesSport', $this->typeSportRepository->findAll());
        $this->twig->addGlobal('cities', $this->cityRepository->findAll());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ControllerEvent::class => 'onControllerEvent',
        ];
    }
}
