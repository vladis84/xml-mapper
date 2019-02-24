<?php

namespace XmlMapperTest;

use PHPUnit\Framework\TestCase;
use XmlMapper\XmlMapper;

class Document
{
    public $Type;
    public $Number;
}

class Passenger
{
    public $Name;

    /**
     * @var \XmlMapperTest\Document
     */
    public $Document;
}

class Entity
{
    /**
     * @var float
     */
    public $Amount;

    /**
     * @var \DateTime
     */
    public $arrivalTime;

    /**
     * @var \XmlMapperTest\Passenger[]
     */
    public $Passenger;
}
/**
 * @group unit
 */
class XmlMapperTest extends TestCase
{
    public function test()
    {
        $xml = new \SimpleXMLElement(<<<XML
<?xml version="1.0" encoding="utf-8" standalone="yes"?>
<Root>
    <Amount>2737.10</Amount>
    <Passenger>
        <Name>John Dou</Name>
        <Document>
            <Type>Passport RU</Type>
            <Number>6505 123456</Number>
        </Document>
    </Passenger>
    <Passenger>
        <Name>First_name Last_name</Name>
    </Passenger>
</Root>
XML

        );

        $mapper = new XmlMapper();

        $transInfo = $mapper->map($xml, Entity::class);

        var_dump($transInfo);
    }
}
