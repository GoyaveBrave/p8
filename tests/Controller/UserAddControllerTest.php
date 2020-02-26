<?php

namespace App\Tests\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserAddControllerTest extends WebTestCase
{
    public function testUserAddController()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin@admin.fr',
            'PHP_AUTH_PW'   => 'admin',
        ]);

        $crawler = $client->request('GET', '/users/create');

        $this->assertSame(200, $client->getResponse()->getStatusCode());

        $this->assertSame(1, $crawler->filter('html:contains("Créer un utilisateur")')->count());

        $form = $crawler->selectButton('Ajouter')->form();

        $form['user[username]'] = 'Uefffusername';
        $form['user[email]'] = 'Emaijizihezfhoilerrre@gmail.com';
        $form['user[password]'] = 'password';
        $form['user[roles]'] = 'ROLE_ADMIN';

        $client->submit($form);

        $crawler = $client->followRedirect();


        $this->assertSame(1, $crawler->filter('html:contains("L\'utilisateur a bien été ajouté.")')->count());
    }
}