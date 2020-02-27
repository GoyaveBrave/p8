<?php

namespace App\Tests\Controller;
use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskToggleControllerTest extends WebTestCase
{
    /** @test */
    public function testToggleTaskAction()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin@admin.fr',
            'PHP_AUTH_PW'   => 'admin',
        ]);
        $id = 77;
        // Get the entityManager
        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');
        // Get a task
        $task = $entityManager->getRepository(Task::class)->find($id);
        // Edit the route
        $route = '/tasks/'.$task->getId().'/toggle';

        // Test
        $this->assertFalse($task->isDone());

        // Request the route
        $client->request('GET', $route);

        // Test
        $this->assertTrue($task->isDone());
        $this->assertTrue($client->getResponse()->isRedirect());
    }
}