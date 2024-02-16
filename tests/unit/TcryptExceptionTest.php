<?php

namespace Tests\unit;

use Codeception\Test\Unit;
use Tankfairies\Tcrypt\TcryptException;
use UnitTester;

class TcryptExceptionTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected UnitTester $tester;

    public function testException()
    {
        $this->tester->expectThrowable(
            new TcryptException('this is a test'),
            function () {
                throw new TcryptException('this is a test');
            }
        );
    }
}
