<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

class CityController extends AbstractController
{
    #[Route('/set-city/{city}', name: 'set_city')]
    public function setCity(Request $request, string $city): Response
    {
        $request->getSession()->set('current_city', $city);
        return $this->redirectToRoute('app_homepage');
    }
}
