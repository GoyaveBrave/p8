<?php

namespace App\Tests\Controller;
use App\Controller\TaskShowController;
use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class TaskShowControllerTest extends WebTestCase
{
    /** @var Environment */
    private $twig;
    /** @var EntityManagerInterface */
    private $em;

    public function setUp()
    {
        static::bootKernel();
        $this->em = static::$kernel->getContainer()->get('doctrine.orm.entity_manager');
        $this->twig = $this->createMock(Environment::class);
    }

    public function testListAction()
    {
        $client = static::createClient();
        $container = $client->getContainer();
        $controller = new TaskShowController($this->twig, $this->em);

        $task1 = new Task();
        $task1->setTitle('Test Title');
        $task1->setContent('Test Content');

        ;
        $task2 = new Task();
        $task2->setTitle('Test Title2');
        $task2->setContent('test content')
        ;

        $task3 = new Task();
        $task3->setTitle('Test Title3');
        $task3->setContent('test content')
        ;

        $this->em->persist($task1);
        $this->em->persist($task2);
        $this->em->persist($task3);
        $this->em->flush();

        $crawler = $client->request('GET', '/tasks');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains($task1->getTitle(), $client->getResponse()->getContent());
        $this->assertContains($task2->getTitle(), $client->getResponse()->getContent());
        $this->assertContains($task3->getTitle(), $client->getResponse()->getContent());
    }
}