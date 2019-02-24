<?php

namespace XmlMapperTest;

use PHPUnit\Framework\TestCase;
use XmlMapper\ObjectDataBuilder;

class Foo
{
    /**
     * @var string
     */
    public $publicProperty;

    private $privateProperty;

    public function testMethod()
    {
    }
}
class ObjectDataBuilderTest extends TestCase
{
    public function testBuild()
    {
        $objectData = ObjectDataBuilder::build(Foo::class);

        $this->assertCount(1, $objectData->properties);
        $this->assertCount(1, $objectData->methods);
    }
}
