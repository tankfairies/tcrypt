<?php

namespace Tests;

use \Codeception\Test\Unit;
use ReflectionProperty;
use Tankfairies\Tcrypt\AbstractCrypt;
use Tankfairies\Tcrypt\TcryptException;

class AbstractCryptTest extends Unit
{

    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testSetLocalKeys()
    {
        $mock = $this->getMockForAbstractClass('Tankfairies\Tcrypt\AbstractCrypt');

        $keys = $this->make('Tankfairies\Tcrypt\Keys');
        $mock->setLocalKeys($keys);

        $reflection = new ReflectionProperty($mock, 'localKeys');
        $reflection->setAccessible(true);
        $this->assertEquals($keys, $reflection->getValue($mock));
    }

    public function testSetForeignKeys()
    {
        $mock = $this->getMockForAbstractClass('Tankfairies\Tcrypt\AbstractCrypt');

        $keys = $this->make('Tankfairies\Tcrypt\Keys');
        $mock->setForeignKey('12345678901234567890');

        $reflection = new ReflectionProperty($mock, 'foreignKey');
        $reflection->setAccessible(true);
        $this->assertEquals('12345678901234567890', $reflection->getValue($mock));
    }

    public function testSetForeignKeyNotSet()
    {
        $mock = $this->getMockForAbstractClass('Tankfairies\Tcrypt\AbstractCrypt');

        $this->tester->expectException(
            new TcryptException('foreign key not set'),
            function () use ($mock) {
                $mock->setForeignKey('');
            }
        );
    }
}
