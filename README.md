# XmlMapper
Entity fill from SimpleXml.

## Example
```xml
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
```
```php

class Entity
{
    /**
     * @var float
     */
    public $Amount;

    /**
     * @var Passenger[]
     */
    public $Passenger;

    public function method()
    {
        
    }
}

class Passenger
{
    public $Name;

    /**
     * @var Document
     */
    public $Document;
}

class Document
{
    public $Type;
    public $Number;
}

$xml = new \SimpleXMLElement('...');

$mapper = new XmlMapper();

$entity = $mapper->map($xml, Entity::class);

var_dump($entity);
```

## Output
```text
class XmlMapperTest\Entity#14 (3) {
  public $Amount =>
  double(2737.1)
  public $arrivalTime =>
  NULL
  public $Passenger =>
  array(2) {
    [0] =>
    class XmlMapperTest\Passenger#17 (2) {
      public $Name =>
      string(8) "John Dou"
      public $Document =>
      class XmlMapperTest\Document#29 (2) {
        public $Type =>
        string(11) "Passport RU"
        public $Number =>
        string(11) "6505 123456"
      }
    }
    [1] =>
    class XmlMapperTest\Passenger#18 (2) {
      public $Name =>
      string(20) "First_name Last_name"
      public $Document =>
      NULL
    }
  }
}
```
