<?php

namespace AppBundle\Entity;

use function date;
use Doctrine\ORM\Mapping as ORM;

/**
 * Metric
 *
 * @ORM\Table(name="metric")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MetricRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Metric
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
     * @var \DateTime $timestamp
     *
     * @ORM\Column(name="timestamp", type="datetime")
     */
    private $timestamp;

    /**
     * @var float $value
     *
     * @ORM\Column(name="value", type="float")
     */
    private $value;

    /**
     * @var bool $thursday
     *
     * @ORM\Column(name="thursday", type="boolean", nullable=true)
     */
    private $thursday;

    /**
     * @var string $type
     *
     * @ORM\Column(name="type", type="string")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="Unit", inversedBy="metrics")
     * @ORM\JoinColumn(name="unit_id", referencedColumnName="id")
     */
    private $unit;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set timestamp
     *
     * @param \DateTime $timestamp
     *
     * @return Metric
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return \DateTime
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set value
     *
     * @param float $value
     *
     * @return Metric
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return bool
     */
    public function isThursday()
    {
        return $this->thursday;
    }

    /**
     * @param bool $thursday
     * @ORM\PreFlush()
     */
    public function setThursday()
    {
        if (!isset($this->thursday)) {
            $this->thursday = (date('N', $this->timestamp->getTimestamp())==4) ? True : False;
        }
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param mixed $unit
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
    }
}

