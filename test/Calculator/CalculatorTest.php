<?php

namespace PhpShow\Test\Calculator;

use PhpShow\Calculator\Calculator;
use PhpShow\Test\Calculator\Assets\CalculatorRequestAssets as Assets;

class CalculatorTest extends \PHPUnit_Framework_TestCase
{
    public function testValidData() {
        $r = Assets::getRequest();
        $c = new Calculator($r['first'], $r['second'], $r['operation']);
        $r = $c->validate()->getResult();
        $this->assertFalse(array_key_exists('errors', $r));

        $rr = 30;
        $this->assertEquals($rr, $r['data']['result']);

        $at = '25 plus 5 = 30';
        $this->assertEquals($at, $r['data']['actionText']);
    }

    public function testValidationFailIfFirstValueIsEmpty()
    {
        $r = Assets::getRequest();
        $r['first'] = '';
        $c = new Calculator($r['first'], $r['second'], $r['operation']);
        $r = $c->validate()->getResult();

        $errors = ['first' => 'First value is empty'];
        $this->assertSame($errors, $r['errors']);
    }

    public function testValidationFailIfFirstValueIsNotNumber()
    {
        $r = Assets::getRequest();
        $r['first'] = 'dd45';
        $c = new Calculator($r['first'], $r['second'], $r['operation']);
        $r = $c->validate()->getResult();

        $errors = ['first' => 'First value is not a valid number'];
        $this->assertSame($errors, $r['errors']);
    }

    public function testValidationFailIfSecondValueIsEmpty()
    {
        $r = Assets::getRequest();
        $r['second'] = '';
        $c = new Calculator($r['first'], $r['second'], $r['operation']);
        $r = $c->validate()->getResult();

        $errors = ['second' => 'Second value is empty'];
        $this->assertSame($errors, $r['errors']);
    }

    public function testValidationFailIfSecondValueIsNotNumber()
    {
        $r = Assets::getRequest();
        $r['second'] = 'dd45';
        $c = new Calculator($r['first'], $r['second'], $r['operation']);
        $r = $c->validate()->getResult();

        $errors = ['second' => 'Second value is not a valid number'];
        $this->assertSame($errors, $r['errors']);
    }

    public function testValidationFailIfOperationIsEmpty()
    {
        $r = Assets::getRequest();
        $r['operation'] = '';
        $c = new Calculator($r['first'], $r['second'], $r['operation']);
        $r = $c->validate()->getResult();

        $errors = ['operation' => 'Operation is empty'];
        $this->assertSame($errors, $r['errors']);
    }

    public function testValidationFailIfOperationIsNotValid()
    {
        $r = Assets::getRequest();
        $r['operation'] = 'plus';
        $c = new Calculator($r['first'], $r['second'], $r['operation']);
        $r = $c->validate()->getResult();

        $errors = ['operation' => 'Operation is not valid'];
        $this->assertSame($errors, $r['errors']);
    }
}

