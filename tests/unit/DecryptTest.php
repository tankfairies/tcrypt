<?php

namespace Tests\unit;

use \Codeception\Test\Unit;
use Tankfairies\Tcrypt\Decrypt;
use Tankfairies\Tcrypt\Encrypt;
use Tankfairies\Tcrypt\TcryptException;
use UnitTester;
use SodiumException;
use Exception;

class DecryptTest extends Unit
{

    /**
     * @var UnitTester
     */
    protected UnitTester $tester;

    /**
     * @throws TcryptException
     * @throws SodiumException
     * @throws Exception
     */
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

        $crypt = new Encrypt();
        $crypt->setLocalKeys($sendKeys)
            ->setForeignKey(hex2bin("751c65c02aee08d307334f0ff2adf1c72e70e7f16e4b93dead1f412d11d86353"));

        $snd = $crypt->enc('my secret message');

        $decrypt = new Decrypt();
        $decrypt
            ->setLocalKeys($sendKeys)
            ->setForeignKey(hex2bin("751c65c02aee08d307334f0ff2adf1c72e70e7f16e4b93dead1f412d11d86353"));

        $this->assertEquals('my secret message', $decrypt->dec($snd));
    }
}
