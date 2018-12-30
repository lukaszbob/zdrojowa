<?php

namespace AppBundle\Weather;


use AppBundle\Entity\Weather;
use Doctrine\ORM\EntityManagerInterface;

class CachedWeatherProvider implements WeatherProviderInterface
{

    private $liveWeatherProvider;
    private $em;

    public function __construct(WeatherProviderInterface $liveWeatherProvider, EntityManagerInterface $entityManager)
    {
        $this->liveWeatherProvider = $liveWeatherProvider;
        $this->em = $entityManager;
    }

    public function getCurrentWeather($locationId): WeatherSpecification
    {
        $cachedWeather = $this->findCachedWeather($locationId);

        if ($cachedWeather && !$cachedWeather->needRefresh()) {
            return $cachedWeather;
        } else {
            $liveWeather = $this->liveWeatherProvider->getCurrentWeather($locationId);
            if ($liveWeather->isCorrect() && !$liveWeather->needRefresh()) {
                $this->saveWeather($liveWeather);
            }
            return $liveWeather;
        }
    }

    private function findCachedWeather($locationId): ?WeatherSpecification
    {
        $cachedRecords = $this->em->getRepository('AppBundle:Weather')->findBy(['locationId' => $locationId], ['updateTime' => 'DESC']);

        if (!$cachedRecords) {
            return null;
        } else {
            $result = reset($cachedRecords);
            return $result->getWeatherSpecification();
        }
    }

    private function saveWeather(WeatherSpecification $weatherSpecification)
    {
        $weatherEntity = new Weather();
        $weatherEntity->setLocationId($weatherSpecification->getLocationId());
        $weatherEntity->setTemperature($weatherSpecification->getTemperature());
        $weatherEntity->setUpdateTime(new \DateTime('@' . $weatherSpecification->getUpdateTime()));

        $this->em->persist($weatherEntity);
        $this->em->flush();
    }


}