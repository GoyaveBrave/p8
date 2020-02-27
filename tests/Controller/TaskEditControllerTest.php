<?php

namespace App\Tests\Controller;
use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class TaskEditControllerTest extends WebTestCase
{
    /** @test */
    public function testEditAction()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin@admin.fr',
            'PHP_AUTH_PW'   => 'admin',
        ]);
        $id = 114;
        // Get the entityManager
        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');
        // Get a task
        $task = $entityManager->getRepository(Task::class)->find($id);
        // Edit the route
        $route = '/tasks/' . $task->getId() . '/edit';
        // Request the route
        $crawler = $client->request('GET', $route);
        // Test
        $this->assertEquals(1, $crawler->filter('form')->count());
        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        // Select the form
        $form = $crawler->selectButton('Modifier')->form();
        // set some values
        $form['task[title]'] = 'A modified title test';
        // submit the form
        $crawler = $client->submit($form);
        // Test
        $this->assertTrue($client->getResponse()->isRedirect());
}
}