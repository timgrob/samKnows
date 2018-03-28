<?php
/**
 * Created by PhpStorm.
 * User: timgrob
 * Date: 3/28/18
 * Time: 9:03 AM
 */

namespace AppBundle\Tests\Command;


use AppBundle\Command\CalculateMetricStatisticsCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class CalculateMetricStatisticsCommandTest extends KernelTestCase
{

    public function testCalculateMetricStatisticsExecute()
    {
        self::bootKernel();
        $application = new Application(self::$kernel);

        $application->add(new CalculateMetricStatisticsCommand());

        $command = $application->find('app:calculate-metric-statistics');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),
            'date' => '2017-02-20'
        ));

        $output = $commandTester->getDisplay();
        $this->assertContains('Mean: 852467.8', $output);
        $this->assertContains('Median: 42215', $output);
    }
}
