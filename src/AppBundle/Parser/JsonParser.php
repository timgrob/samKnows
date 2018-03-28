<?php
/**
 * Created by PhpStorm.
 * User: timgrob
 * Date: 3/26/18
 * Time: 5:10 PM
 */

namespace AppBundle\Parser;


use AppBundle\Entity\Metric;
use AppBundle\Entity\Unit;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class JsonParser extends Parser
{
    /**
     * ParserJson constructor.
     * @param $jsonObj
     */
    public function __construct()
    {
    }


    public function execute()
    {
        $serializer = new Serializer(
            array(new ObjectNormalizer()),
            array(new JsonEncoder())
        );

        $units = $serializer->decode($this->dataObject, 'json');

        $parsedData = new ArrayCollection();
        foreach ($units as $unit) {
            $unitEntity = new Unit();
            $unitEntity->setDeviceId($unit['unit_id']);
            $metrics = $unit['metrics'];
            foreach ($metrics as $key => $metric) {
                foreach ($metric as $entry) {
                    $metricEntity = new Metric();
                    $metricEntity->setTimestamp(new DateTime($entry['timestamp']));
                    $metricEntity->setValue($entry['value']);
                    $metricEntity->setUnit($unitEntity);
                    $metricEntity->setType($key);
                    $unitEntity->addMetric($metricEntity);
                }
            }
            $parsedData->add($unitEntity);
        }

        // ArrayCollection
        return $parsedData;
    }


}