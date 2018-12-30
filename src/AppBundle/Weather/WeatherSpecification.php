<?php

namespace AppBundle\Weather;

class WeatherSpecification
{

    private $updateTime;
    private $temperature;
    private $locationId;

    public function __construct($updateTime, $temperature, $locationId)
    {
        $this->updateTime = $updateTime;
        $this->temperature = $temperature;
        $this->locationId = $locationId;
    }


    public function getUpdateTime()
    {
        return $this->updateTime;
    }


    public function getTemperature()
    {
        return $this->temperature;
    }


    public function getLocationId()
    {
        return $this->locationId;
    }

    public function needRefresh(){
        return false;
    }

    public function isCorrect(){
        return (!is_null($this->temperature));
    }




}