<?php

namespace XmlMapperTest;

use PHPUnit\Framework\TestCase;
use XmlMapper\EntityParser;
use XmlMapperTest\Entity\Entity;

/**
 * @group unit
 */
class EntityParserTest extends TestCase
{
    public function testUnknownEntityClass()
    {
        $parser = new EntityParser();

        $this->expectException(\LogicException::class);

        $parser->parse('UnknownEntityClass');
    }

    public function testBuildFillProperties()
    {
        $parser = new EntityParser();
        $objectData = $parser->parse(Entity::class);

        $this->assertCount(2, $objectData->properties);
    }

    public function testBuildFillMethods()
    {
        $parser = new EntityParser();
        $objectData = $parser->parse(Entity::class);

        $this->assertCount(1, $objectData->methods);
    }
}
