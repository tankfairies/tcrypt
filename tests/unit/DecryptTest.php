<?php

namespace Tests;

use \Codeception\Test\Unit;
use Tankfairies\Tcrypt\Decrypt;
use Tankfairies\Tcrypt\Encrypt;

class DecryptTest extends Unit
{

    protected $decrypt;

    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $this->decrypt = new Decrypt();
    }

    protected function _after()
    {
        $this->decrypt = null;
    }


    public function testDec()
    {
        $sendKeys = $this->make(
            'Tankfairies\Tcrypt\Keys',
            [
                'getSecretKey' => function () {
                    return hex2bin("a322e905bd29167702bfc816a6e5ad2be0d8ede171d3c6e68497a5ef5b316d08");
                }
            ]
        );

        $receiveKeys = $this->make(
            'Tankfairies\Tcrypt\Keys',
            [
                'getPublicKey' => function () {
                    return hex2bin("751c65c02aee08d307334f0ff2adf1c72e70e7f16e4b93dead1f412d11d86353");
                }
            ]
        );

        $crypt = new Encrypt();
        $crypt->setLocalKeys($sendKeys)->setForeignKey($receiveKeys->getPublicKey());

        $snd = $crypt->enc('my secret message');

        $this->decrypt
            ->setLocalKeys($sendKeys)
            ->setForeignKey($receiveKeys->getPublicKey());

        $this->assertEquals('my secret message', $this->decrypt->dec($snd));
    }
}
