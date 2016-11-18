<?php

namespace UMA\Tests\ApiProblemBundle;

use Symfony\Component\BrowserKit\Client;
use Symfony\Component\HttpFoundation\Response;

class FullSpectrumTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Client
     */
    private $client;

    protected function setUp()
    {
        $kernel = new \TestKernel();
        $kernel->boot();

        $this->client = $kernel->getContainer()->get('test.client');

        parent::setUp();
    }

    public function testSimpleProblem()
    {
        $this->client
            ->request('GET', '/');

        $response = $this->client->getInternalResponse();

        self::assertSame(Response::HTTP_BAD_REQUEST, $response->getStatus());
    }
}
