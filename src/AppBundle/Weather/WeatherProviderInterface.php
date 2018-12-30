<?php

namespace AppBundle\Weather;

interface WeatherProviderInterface
{
    public function getCurrentWeather($locationId) : WeatherSpecification;
}