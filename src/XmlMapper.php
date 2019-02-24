<?php

namespace XmlMapper;

class XmlMapper
{
    public function map(\SimpleXMLElement $xml, string $entityClassName)
    {
        $entity = new $entityClassName;

        $entityParser = new EntityParser();
        $objectData   = $entityParser->parse($entityClassName);

        foreach ($xml->children() as $element) {
            $propertyName = $element->getName();
            $setterName   = 'set' . ucfirst($propertyName);

            $setter   = $objectData->methods[$setterName] ?? null;
            $property = $objectData->properties[$propertyName] ?? null;

            if (!$setter && !$property) {
                continue;
            }
            elseif ($setter) {
                call_user_func([$entity, $setter], $element);
            }
            elseif ($property->isSimple()) {
                settype($element, $property->type);
                $entity->{$propertyName} = $element;
            }
            elseif ($property->isEntityList()) {
                $childEntities        = $entity->{$propertyName} ?: [];
                $childEntityClassName = str_replace(['[', ']'], '', $property->type);

                $childEntities[]         = $this->map($element, $childEntityClassName);
                $entity->{$propertyName} = $childEntities;
            }
            elseif ($property->isEntity()) {
                $childEntity             = $this->map($element, $property->type);
                $entity->{$propertyName} = $childEntity;
            }
        }

        return $entity;
    }
}
