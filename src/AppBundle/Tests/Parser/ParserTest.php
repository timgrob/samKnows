<?php

namespace AppBundle\Tests\Parser;


use AppBundle\Parser\JsonParser;
use Doctrine\Common\Collections\ArrayCollection;
use function dump;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class ParserTest extends TestCase
{
    public function testParser() {

        $str = file_get_contents(__dir__.'/testInputParser.json');

        $parser = new JsonParser();
        $parser->load($str);

        /** @var ArrayCollection $result */
        $result = $parser->execute();

        $this->assertEquals(1, $result->count());
        $this->assertEquals(1, $result->first()->getDeviceId());
        $this->assertEquals(43,$result->first()->getMetrics()->count());
        $this->assertEquals('download', $result->first()->getMetrics()->first()->getType());
    }
}