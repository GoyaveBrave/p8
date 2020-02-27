<?php

namespace App\Tests\Controller;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class UserShowControllerTest extends WebTestCase
{
    /** @test */
    public function listActionTest()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin@admin.fr',
            'PHP_AUTH_PW'   => 'admin',
        ]);
        $container = $client->getContainer();
        $em = $container->get('doctrine')->getManager();

        $user1 = new User();
        $user1->setEmail('Testt@Title348655.fr');
        $user1->setUsername('Test ustu111');
        $user1->setPassword('Test psw');
        $user1->setRoles(array('ROLE_ADMIN'));

        $user2 = new User();
        $user2->setEmail('Testt@Title2455.fr');
        $user2->setUsername('test ustu222');
        $user2->setPassword('test psw');
        $user2->setRoles(array('ROLE_ADMIN'));

        $user3 = new User();
        $user3->setEmail('Testt@Title3243.fr');
        $user3->setUsername('test ustu333');
        $user3->setPassword('test psw');
        $user3->setRoles(array('ROLE_ADMIN'));


        $em->persist($user1);
        $em->persist($user2);
        $em->persist($user3);
        $em->flush();

        $crawler = $client->request('GET', '/admin/users');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains($user1->getEmail(), $client->getResponse()->getContent());
        $this->assertContains($user2->getEmail(), $client->getResponse()->getContent());
        $this->assertContains($user3->getEmail(), $client->getResponse()->getContent());
    }

}