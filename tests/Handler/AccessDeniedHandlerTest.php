<?php

namespace App\Tests\Handler;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AccessDeniedHandlerTest extends WebTestCase
{
    /** @test */
    public function testHandle()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        static::assertSame(200, $client->getResponse()->getStatusCode());
    }
}