<?php

namespace UMA\Tests\ApiProblemBundle;

use Symfony\Component\BrowserKit\Client;

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
}
