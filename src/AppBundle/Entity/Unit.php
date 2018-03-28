<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Unit
 *
 * @ORM\Table(name="unit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UnitRepository")
 */
class Unit
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="device_id", type="integer")
     */
    private $deviceId;

    /**
     * @ORM\OneToMany(targetEntity="Metric", mappedBy="unit", cascade={"persist", "remove"})
     */
    private $metrics;

    /**
     * Unit constructor.
     */
    public function __construct()
    {
        $this->metrics = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getDeviceId()
    {
        return $this->deviceId;
    }

    /**
     * @param int $deviceId
     */
    public function setDeviceId($deviceId)
    {
        $this->deviceId = $deviceId;
    }

    /**
     * @param int $unit_id
     */
    public function setUnitId($unitId)
    {
        $this->unitId = $unitId;
    }

    /**
     * @return mixed
     */
    public function getMetrics()
    {
        return $this->metrics;
    }

    /**
     * @param $metrics
     * @return Unit
     */
    public function setMetrics(ArrayCollection $metrics)
    {
        $this->metrics = $metrics;

        return $this;
    }

    /**
     * @param Metric $metric
     */
    public function addMetric(Metric $metric)
    {
        $this->metrics->add($metric);
    }

}

