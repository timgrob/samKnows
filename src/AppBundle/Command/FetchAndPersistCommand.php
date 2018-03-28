<?php
/**
 * Created by PhpStorm.
 * User: timgrob
 * Date: 3/26/18
 * Time: 4:12 PM
 */

namespace AppBundle\Command;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\OptimisticLockException;
use function dump;
use function sprintf;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Acl\Exception\Exception;

class FetchAndPersistCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('app:fetch-and-persist')
            ->setDescription('Fetches data from a URL and persists data in database')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $jsonData = file_get_contents($this->getContainer()->getParameter('url_address'));

        $parser = $this->getContainer()->get('app.json_parser');
        $parser->load($jsonData);

        /** @var ArrayCollection $units */
        $units = $parser->execute();

        $output->writeln(sprintf('Number of unit devices: %d', $units->count()));

        $unitRepository = $this->getContainer()->get('app.unit_entity_repository');
        $unitRepository->save($units);

        $output->writeln('--- Entities persisted ---');
    }
}