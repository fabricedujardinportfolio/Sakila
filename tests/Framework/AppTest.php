<?php
namespace Test\Framework;

use Framework\App;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase{

    public function testRedirectTrailingSlash()
    {
        $app = new App();
        // $_SERVER['REQUEST_URI'] = '/fbhdkjf';
        $request = new Request('/fbhdkjf/');
        $reponse = $app->run($request);
        $this->assertEquals('/fbhdkjf', $reponse->getHeader('Location'));
        $this->assertContainsEquals(301,$reponse->getStatus());
    }
}