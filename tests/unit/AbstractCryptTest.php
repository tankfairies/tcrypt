<?php

namespace Tests\unit;

use Codeception\Test\Unit;
use ReflectionProperty;
use Tankfairies\Tcrypt\AbstractCrypt;
use Tankfairies\Tcrypt\TcryptException;
use UnitTester;
use ReflectionException;
use Exception;

class AbstractCryptTest extends Unit
{

    /**
     * @var UnitTester
     */
    protected UnitTester $tester;

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public function testSetLocalKeys()
    {
        $mock = new class extends AbstractCrypt {
        };

        $keys = $this->make('Tankfairies\Tcrypt\Keys');
        $mock->setLocalKeys($keys);

        $reflection = new ReflectionProperty($mock, 'localKeys');
        $this->assertEquals($keys, $reflection->getValue($mock));
    }

    /**
     * @throws ReflectionException
     * @throws TcryptException
     * @throws Exception
     */
    public function testSetForeignKeys()
    {
        $mock = new class extends AbstractCrypt {
        };

        $mock->setForeignKey('12345678901234567890');

        $reflection = new ReflectionProperty($mock, 'foreignKey');
        $this->assertEquals(hex2bin('12345678901234567890'), $reflection->getValue($mock));
    }

    public function testSetForeignKeyNotSet()
    {
        $mock = new class extends AbstractCrypt {
        };

        $this->tester->expectThrowable(
            new TcryptException('foreign key not set'),
            function () use ($mock) {
                $mock->setForeignKey('');
            }
        );
    }
}
