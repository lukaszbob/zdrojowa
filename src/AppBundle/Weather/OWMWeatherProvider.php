<?php

namespace AppBundle\Weather;

use GuzzleHttp\Client;

class OWMWeatherProvider implements WeatherProviderInterface
{

    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getCurrentWeather($locationId): WeatherSpecification
    {
        $client = new Client(
            ['base_uri' => 'http://api.openweathermap.org/data/2.5/']
        );
        try {
            $result = $client->request('GET', 'weather', [
                'query' => [
                    'id' => $locationId,
                    'APPID' => $this->apiKey,
                    'lang' => 'PL',
                    'units' => 'metric'
                ]
            ]);

            $response = \GuzzleHttp\json_decode($result->getBody()->getContents());

            return new WeatherSpecification($response->dt, $response->main->temp, $locationId);

        } catch (\GuzzleHttp\Exception\GuzzleException | \RuntimeException | \InvalidArgumentException $exception) {
            return new WeatherSpecification(time(), null, $locationId);
        }
    }


}