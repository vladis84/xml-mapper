<?php

namespace XmlMapper;

use XmlMapper\ObjectData\Property;

class ObjectDataBuilder
{
    public static function build(string $entityClassName): ObjectData
    {
        $objectData = new ObjectData();

        $reflectionClass = new \ReflectionClass($entityClassName);

        self::buildProperties($objectData, $reflectionClass);
        self::buildMethods($objectData, $reflectionClass);

        return $objectData;
    }

    private static function buildProperties(ObjectData $objectData, \ReflectionClass $reflectionClass): void
    {
        $reflectionProperties = $reflectionClass->getProperties(\ReflectionProperty::IS_PUBLIC);

        foreach ($reflectionProperties as $reflectionProperty) {
            $property = new Property();

            $property->name = $reflectionProperty->getName();

            $matches = [];
            if (preg_match('/@var\s+(?<type>[(\\\\\w\[\]]+)/', $reflectionProperty->getDocComment(), $matches)) {
                $property->type = $matches['type'];
            }

            $objectData->properties[$property->name] = $property;
        }
    }

    private static function buildMethods(ObjectData $objectData, \ReflectionClass $reflectionClass): void
    {
        $methods = $reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC);

        foreach ($methods as $method) {
            $objectData->methods[$method->getName()] = $method->getName();
        }
    }
}
