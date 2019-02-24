<?php

namespace XmlMapperTest\ObjectData;

use XmlMapper\ObjectData\Property;
use PHPUnit\Framework\TestCase;
use XmlMapper\ObjectData\PropertyTypeEnum;

/**
 * @group unit
 */
class PropertyTest extends TestCase
{
    public function testIsEntity()
    {
        $property = new Property();
        $property->type = 'FooClass';

        $isEntity = $property->isEntity();

        $this->assertTrue($isEntity);
    }

    public function testIsEntityList()
    {
        $property = new Property();
        $property->type = 'FooClass[]';

        $isEntity = $property->isEntityList();

        $this->assertTrue($isEntity);
    }

    public function testIsSimple()
    {
        $property = new Property();
        $property->type = PropertyTypeEnum::BOOL_SHORT;

        $isEntity = $property->isSimple();

        $this->assertTrue($isEntity);
    }
}
