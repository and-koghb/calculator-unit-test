<?php

namespace PhpShow\Test\Calculator\Assets;

class CalculatorRequestAssets extends \PHPUnit_Framework_TestCase
{
    const VALUE_FIRST = '25';
    const VALUE_SECOND = '5';
    const VALUE_OPERATION = 'add';

    public static function getRequest() {
        return [
            'first' => self::VALUE_FIRST,
            'second' => self::VALUE_SECOND,
            'operation' => self::VALUE_OPERATION
        ];
    }
}