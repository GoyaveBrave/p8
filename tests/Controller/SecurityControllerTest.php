<?php

namespace App\Tests\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testLogin()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
        static::assertSame(200, $client->getResponse()->getStatusCode());

        // Test if login field exists
        static::assertSame(1, $crawler->filter('input[name="email"]')->count());
        static::assertSame(1, $crawler->filter('input[name="password"]')->count());

        $form = $crawler->selectButton('Se connecter')->form();
        $form['email'] = 'admin@admin.fr';
        $form['password'] = 'admin';
        $client->submit($form);

        $crawler = $client->followRedirect();
        static::assertSame(200, $client->getResponse()->getStatusCode());


        static::assertSame(1, $crawler->filter('html:contains("Bienvenue sur Todo List !")')->count());


        return $client;
    }
}