<?php

namespace AppBundle\Entity;

use AppBundle\Weather\WeatherSpecification;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class Weather
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="datetimetz")
     */
    private $updateTime;

    /**
     * @ORM\Column(type="decimal");
     */
    private $temperature;

    /**
     * @ORM\Column(type="integer")
     */
    private $locationId;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set updateTime.
     *
     * @param \DateTime $updateTime
     *
     * @return Weather
     */
    public function setUpdateTime($updateTime)
    {
        $this->updateTime = $updateTime;

        return $this;
    }

    /**
     * Get updateTime.
     *
     * @return \DateTime
     */
    public function getUpdateTime()
    {
        return $this->updateTime;
    }

    /**
     * Set temperature.
     *
     * @param string $temperature
     *
     * @return Weather
     */
    public function setTemperature($temperature)
    {
        $this->temperature = $temperature;

        return $this;
    }

    /**
     * Get temperature.
     *
     * @return string
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * Set locationId.
     *
     * @param int $locationId
     *
     * @return Weather
     */
    public function setLocationId($locationId)
    {
        $this->locationId = $locationId;

        return $this;
    }

    /**
     * Get locationId.
     *
     * @return int
     */
    public function getLocationId()
    {
        return $this->locationId;
    }

    public function getWeatherSpecification()
    {
        return new WeatherSpecification($this->getUpdateTime()->getTimestamp(), $this->temperature, $this->locationId);
    }
}
