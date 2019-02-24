<?php

namespace XmlMapperTest;

use PHPUnit\Framework\TestCase;
use XmlMapper\XmlMapper;
use XmlMapperTest\Entity\Entity;

/**
 * @group unit
 */
class XmlMapperTest extends TestCase
{
    public function test()
    {
        $xml = simplexml_load_file(__DIR__ . '/fixture/EntityList.xml');

        $mapper = new XmlMapper();

        $transInfo = $mapper->map($xml, Entity::class);

        var_dump($transInfo);
    }
}
