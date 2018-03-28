<?php
/**
 * Created by PhpStorm.
 * User: timgrob
 * Date: 3/27/18
 * Time: 8:47 AM
 */

namespace AppBundle\Command;


use DateTime;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CalculateMetricStatisticsCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('app:calculate-metric-statistics')
            ->setDescription('Creates a new user.')
            ->setHelp('Calculates mean and median of metrics at a specific date')
            ->addArgument('date', InputArgument::REQUIRED, 'Date is required.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Calculate metric statistics at date: '.$input->getArgument('date'));

        $metricStatistics = $this->getContainer()->get('app.metric_statistics');
        $mean   = $metricStatistics->calculateMeanAtDate(new DateTime($input->getArgument('date')));
        $median = $metricStatistics->calculateMedianAtDate(new DateTime($input->getArgument('date')));

        $output->writeln('Mean: '.$mean);
        $output->writeln('Median: '.$median);
    }

}
