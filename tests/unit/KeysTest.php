<?php

namespace Tests\unit;

use Codeception\Test\Unit;
use Tankfairies\Tcrypt\Keys;
use ReflectionProperty;
use Tankfairies\Tcrypt\TcryptException;
use UnitTester;
use ReflectionException;
use SodiumException;

class KeysTest extends Unit
{

    /**
     * @var UnitTester
     */
    protected UnitTester $tester;


    /**
     * @throws ReflectionException
     * @throws SodiumException
     * @throws TcryptException
     */
    public function testSetPasswordAndSalt()
    {
        $keys = new Keys();
        $keys->setPasswordAndSalt('sendpassword', '1234567890123456');

        $reflection = new ReflectionProperty($keys, 'secretKey');
        $this->assertEquals(
            "e1599279b366e73a92f12256468a172c3c2ba15dbd73df825b8f5211177db831",
            bin2hex($reflection->getValue($keys))
        );

        $reflection = new ReflectionProperty($keys, 'publicKey');
        $this->assertEquals(
            "a322e905bd29167702bfc816a6e5ad2be0d8ede171d3c6e68497a5ef5b316d08",
            bin2hex($reflection->getValue($keys))
        );
    }

    public function testSetPasswordAndSaltInvalidSalt()
    {
        $this->tester->expectThrowable(
            new TcryptException('salt need to be at least 15 chars long'),
            function () {
                $keys = new Keys();
                $keys->setPasswordAndSalt('sendpassword', '1234567890');
            }
        );
    }

    public function testSetPasswordAndSaltNoPassword()
    {
        $this->tester->expectThrowable(
            new TcryptException('no password set'),
            function () {
                $keys = new Keys();
                $keys->setPasswordAndSalt('', '1234567890');
            }
        );
    }

    /**
     * @throws TcryptException
     * @throws SodiumException
     */
    public function testGetSecretKey()
    {
        $keys = new Keys();
        $keys->setPasswordAndSalt('sendpassword', '1234567890123456');

        $this->assertEquals(
            "e1599279b366e73a92f12256468a172c3c2ba15dbd73df825b8f5211177db831",
            bin2hex($keys->getSecretKey())
        );
    }

    public function testGetSecretKeyKeysNotSet()
    {
        $this->tester->expectThrowable(
            new TcryptException('password and salt not set'),
            function () {
                $keys = new Keys();
                $keys->getSecretKey();
            }
        );
    }

    /**
     * @throws TcryptException
     * @throws SodiumException
     */
    public function testGetPublicKeyKey()
    {
        $keys = new Keys();
        $keys->setPasswordAndSalt('receivepassword', '1234567890123456');

        $this->assertEquals(
            "751c65c02aee08d307334f0ff2adf1c72e70e7f16e4b93dead1f412d11d86353",
            $keys->getPublicKey()
        );
    }

    public function testGetPublicKeyKeysNotSet()
    {
        $this->tester->expectThrowable(
            new TcryptException('password and salt not set'),
            function () {
                $keys = new Keys();
                $keys->getPublicKey();
            }
        );
    }
}
