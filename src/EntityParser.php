<?php

namespace XmlMapper;

use XmlMapper\ObjectData\Property;

class EntityParser
{
    /**
     * @var \ReflectionClass
     */
    private $reflectionClass;

    public function parse(string $entityClassName): ObjectData
    {
        if (!class_exists($entityClassName)) {
            $message = sprintf('Not found class "%s"', $entityClassName);
            throw new \LogicException($message);
        }
        $this->reflectionClass = new \ReflectionClass($entityClassName);

        $objectData = new ObjectData();

        $this->buildProperties($objectData);
        $this->buildMethods($objectData);

        return $objectData;
    }

    private function buildProperties(ObjectData $objectData): void
    {
        $reflectionClass = $this->reflectionClass;

        $baseNameSpace        = $reflectionClass->getNamespaceName();
        $reflectionProperties = $reflectionClass->getProperties(\ReflectionProperty::IS_PUBLIC);

        foreach ($reflectionProperties as $reflectionProperty) {
            $property = new Property();

            $property->name = $reflectionProperty->getName();


            // Parse  property  type from phpdoc.
            $matches = [];
            if (preg_match('/@var\s+(?<type>[(\\\\\w\[\]]+)/', $reflectionProperty->getDocComment(), $matches)) {
                $property->type = $matches['type'];
            }

            // Relatively namespace.
            if (!$property->isSimple() && $property->type[0] != '\\') {
                $property->type = sprintf('\\%s\\%s', $baseNameSpace, $property->type);
            }

            $objectData->properties[$property->name] = $property;
        }
    }

    private function buildMethods(ObjectData $objectData): void
    {
        $methods = $this->reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC);

        foreach ($methods as $method) {
            $objectData->methods[$method->getName()] = $method->getName();
        }
    }
}
