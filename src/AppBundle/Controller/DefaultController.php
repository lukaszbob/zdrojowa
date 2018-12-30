<?php

namespace AppBundle\Controller;

use AppBundle\Weather\WeatherProviderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request, WeatherProviderInterface $weatherProvider)
    {
        $weather = $weatherProvider->getCurrentWeather(756135);
        return $this->render('default/index.html.twig', [
            'weather' => $weather,
        ]);
    }
}
