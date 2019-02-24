<?php

namespace XmlMapper\ObjectData;

class Property
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $type = 'string';

    public function isSimple(): bool
    {
        return in_array($this->type, PropertyTypeEnum::getList());
    }

    public function isEntityList(): bool
    {
        $isArray   = strpos($this->type, '[]') > 0;

        return $isArray;
    }

    public function isEntity(): bool
    {
        return !in_array($this->type, PropertyTypeEnum::getList());
    }
}
