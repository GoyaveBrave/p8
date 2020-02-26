<?php

namespace App\Tests\Controller;
use App\Controller\UserEditController;
use App\Entity\Task;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserEditControllerTest extends WebTestCase
{
       public function testEditAction()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin69',
            'PHP_AUTH_PW'   => 'admin',
        ]);
        $crawler = $client->request('GET', '/admin/users/45/edit');
        $this->assertSame(302, $client->getResponse()->getStatusCode());

        $this->assertSame(1, $crawler->filter('html:contains("Modifier")')->count());

        $form = $crawler->selectButton('Modifier')->form();

        $form['user[username]'] = 'test usn3';
        $form['user[email]'] = 'admin@gmail.com';
        $form['user[password]'] = 'password';
        $form['user[roles][0]'] = 'ROLE_ADMIN';

        $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSame(1, $crawler->filter('html:contains("L\'utilisateur a bien été modifié")')->count());
    }
}