<?php

namespace XmlMapper\ObjectData;

abstract class PropertyTypeEnum
{
    const BOOL_LONG  = 'boolean';
    const BOOL_SHORT = 'bool';
    const INT_LONG   = 'integer';
    const INT_SHORT  = 'int';
    const FLOAT      = 'float';
    const DOUBLE     = 'double';
    const STRING     = 'string';
    const ARRAY      = 'array';
    const OBJECT     = 'object';
    const NULL       = 'null';

    public static function getList(): array
    {
        return [
            self::BOOL_LONG,
            self::BOOL_SHORT,
            self::INT_LONG,
            self::INT_SHORT,
            self::FLOAT,
            self::DOUBLE,
            self::STRING,
            self::ARRAY,
            self::OBJECT,
            self::NULL,
        ];
    }
}
