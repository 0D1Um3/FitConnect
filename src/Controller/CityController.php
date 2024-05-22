<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class CityController extends AbstractController
{
    #[Route('/set-city', name: 'app__set_city', methods: ['POST'])]
    public function setCity(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        if (!isset($data['city'])) {
            return new Response('City not provided', Response::HTTP_BAD_REQUEST);
        }

        $city = $data['city'];
        // Сохранение выбранного города в сессию
        $request->getSession()->set('selected_city', $city);

        return $this->redirectToRoute('index', ['city' => $city]);
    }
}
