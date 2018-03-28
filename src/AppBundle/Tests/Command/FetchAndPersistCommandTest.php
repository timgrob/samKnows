<?php
/**
 * Created by PhpStorm.
 * User: timgrob
 * Date: 3/28/18
 * Time: 10:25 AM
 */

namespace AppBundle\Tests\Command;


use AppBundle\Command\FetchAndPersistCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class FetchAndPersistCommandTest extends KernelTestCase
{
    public function testFetchAndPersistExecute()
    {
        self::bootKernel();
        $application = new Application(self::$kernel);

        $application->add(new FetchAndPersistCommand());

        $command = $application->find('app:fetch-and-persist');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName()
        ));


        $output = $commandTester->getDisplay();
        $this->assertContains('Number of unit devices: 9', $output);
        $this->assertContains('--- Entities persisted ---', $output);
    }
}
