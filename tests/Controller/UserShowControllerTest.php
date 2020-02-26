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
        $client = static::createClient();
        $container = $client->getContainer();
        $em = $container->get('doctrine')->getManager();

        $user1 = new User();
        $user1->setEmail('Test Title365');
        $user1->setUsername('Test usn1');
        $user1->setPassword('Test psw');
        $user1->setRoles(array('ROLE_ADMIN'));

        $user2 = new User();
        $user2->setEmail('Test Title23');
        $user2->setUsername('test usn2');
        $user2->setPassword('test psw');
        $user2->setRoles(array('ROLE_ADMIN'));

        $user3 = new User();
        $user3->setEmail('Test Title33');
        $user3->setUsername('test usn3');
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