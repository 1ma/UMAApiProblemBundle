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

    /**
     * @dataProvider scenarioProvider
     *
     * @param string $path
     * @param int    $expectedResponse
     */
    public function testScenario($path, $expectedResponse)
    {
        $this->client
            ->request('GET', $path);

        $response = $this->client->getInternalResponse();

        self::assertSame($expectedResponse, $response->getStatus());
    }

    public function scenarioProvider()
    {
        return [
            'Event listener not called on happy path' => ['/', Response::HTTP_OK],
            'Api Problem returned with own status code' => ['/?trigger_downtime', Response::HTTP_SERVICE_UNAVAILABLE],
            'Api Problem returned with default status code' => ['/?trigger_generic_problem', Response::HTTP_INTERNAL_SERVER_ERROR],
        ];
    }

    public function testListenerOnlyHandlesApiProblemObjects()
    {
        self::expectException(\LogicException::class);

        $this->client
            ->request('GET', '/?trigger_exception');
    }
}
