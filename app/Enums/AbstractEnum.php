<?php

namespace App\Enums;


class AbstractEnum
{
    public static function getAll()
    {
        $reflector = new \ReflectionClass(get_called_class());

        return $reflector->getConstants();
    }
}