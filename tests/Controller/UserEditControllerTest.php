<?php

namespace App\Tests\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserEditControllerTest extends WebTestCase
{
       public function testEditAction()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin@admin.fr',
            'PHP_AUTH_PW'   => 'admin',
        ]);
        $crawler = $client->request('GET', '/admin/users/59/edit');
        $this->assertSame(200, $client->getResponse()->getStatusCode());

        $this->assertSame(1, $crawler->filter('html:contains("Modifier")')->count());

        $form = $crawler->selectButton('Modifier')->form();

        $form['user[username]'] = 'testouchee';
        $form['user[email]'] = 'adminouche@gmail.com';
        $form['user[password]'] = 'password';
        $form['user[roles]'] = 'ROLE_ADMIN';

        $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSame(1, $crawler->filter('html:contains("L\'utilisateur a bien été modifié")')->count());
    }
}