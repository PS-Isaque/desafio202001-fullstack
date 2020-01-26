<?php


class DocsControllerTest extends \Tests\BaseTestCase
{

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testDoc()
    {
        $request = $this->runApp('GET', '/doc');

        $this->assertEquals(\Slim\Http\StatusCode::HTTP_OK, $request->getStatusCode());
    }
}