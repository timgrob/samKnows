<?php
/**
 * Created by PhpStorm.
 * User: timgrob
 * Date: 3/27/18
 * Time: 12:17 PM
 */

namespace AppBundle\Statistics;


use AppBundle\Repository\MetricRepository;
use function array_reduce;
use function count;
use DateTime;
use function floatval;
use function is_array;


class MetricStatistics
{
    private $metricRepository;

    /**
     * MetricStatistics constructor.
     * @param MetricRepository $metricRepository
     */
    public function __construct(MetricRepository $metricRepository)
    {
        $this->metricRepository = $metricRepository;
    }

    public function calculateMeanAtDate(DateTime $date)
    {
        $mean = $this->metricRepository->findMetricValuesAverageAtDate($date);
        return $this->formatArray($mean);
    }

    public function calculateMedianAtDate(DateTime $date)
    {
        $metricValuesOrdered = $this->metricRepository->findMetricValuesOrderedAtDate($date);
        if (count($metricValuesOrdered) % 2 == 0) {
            $metricElements = array_slice($metricValuesOrdered,count($metricValuesOrdered)/2-1,2);
        } else {
            $metricElements = array_slice($metricValuesOrdered,ceil(count($metricValuesOrdered)/2)-1,1);
        }

        $sum = array_reduce($metricElements, function ($c,$e){
            $c += $e['value'];
            return $c;
        });

        return $this->formatArray($sum/count($metricElements));
    }

    private function formatArray($data)
    {
        if (!is_array($data)) {
            return round(floatval($data),2);
        }

        return round(floatval($data[0][1]),2);
    }
}
