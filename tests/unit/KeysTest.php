<?php

namespace Tests;

use \Codeception\Test\Unit;
use Tankfairies\Tcrypt\Keys;
use ReflectionProperty;
use Tankfairies\Tcrypt\TcryptException;

class KeysTest extends Unit
{

    protected $keys;

    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $this->keys = new Keys();
    }

    protected function _after()
    {
        $this->keys = null;
    }

    public function testSetPasswordAndSalt()
    {
        $this->keys->setPasswordAndSalt('sendpassword', '1234567890123456');

        $reflection = new ReflectionProperty($this->keys, 'secretKey');
        $reflection->setAccessible(true);
        $this->assertEquals(
            "e1599279b366e73a92f12256468a172c3c2ba15dbd73df825b8f5211177db831",
            bin2hex($reflection->getValue($this->keys))
        );

        $reflection = new ReflectionProperty($this->keys, 'publicKey');
        $reflection->setAccessible(true);
        $this->assertEquals(
            "a322e905bd29167702bfc816a6e5ad2be0d8ede171d3c6e68497a5ef5b316d08",
            bin2hex($reflection->getValue($this->keys))
        );
    }

    public function testSetPasswordAndSaltInvalidSalt()
    {
        $this->tester->expectException(
            new TcryptException('salt need to be at least 15 chars long'),
            function () {
                $this->keys->setPasswordAndSalt('sendpassword', '1234567890');
            }
        );
    }

    public function testSetPasswordAndSaltNoPassword()
    {
        $this->tester->expectException(
            new TcryptException('no password set'),
            function () {
                $this->keys->setPasswordAndSalt('', '1234567890');
            }
        );
    }

    public function testGetSecretKey()
    {
        $this->keys->setPasswordAndSalt('sendpassword', '1234567890123456');

        $this->assertEquals(
            "e1599279b366e73a92f12256468a172c3c2ba15dbd73df825b8f5211177db831",
            bin2hex($this->keys->getSecretKey())
        );
    }

    public function testGetSecretKeyKeysNotSet()
    {
        $this->tester->expectException(
            new TcryptException('password and salt not set'),
            function () {
                $this->keys->getSecretKey();
            }
        );
    }

    public function testGetPublicKeyKey()
    {
        $this->keys->setPasswordAndSalt('receivepassword', '1234567890123456');

        $this->assertEquals(
            "751c65c02aee08d307334f0ff2adf1c72e70e7f16e4b93dead1f412d11d86353",
            bin2hex($this->keys->getPublicKey())
        );
    }

    public function testGetPublicKeyKeysNotSet()
    {
        $this->tester->expectException(
            new TcryptException('password and salt not set'),
            function () {
                $this->keys->getPublicKey();
            }
        );
    }
}
