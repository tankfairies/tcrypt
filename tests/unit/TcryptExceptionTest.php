<?php

namespace Tests\Libs;

use \Codeception\Test\Unit;
use Tankfairies\Tcrypt\TcryptException;

class TcryptExceptionTest extends Unit
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

    public function testException()
    {
        $this->tester->expectException(
            new TcryptException('this is a test'),
            function () {
                throw new TcryptException('this is a test');
            }
        );
    }
}
