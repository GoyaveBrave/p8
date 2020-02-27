<?php

namespace App\Tests\Controller;
use App\Controller\TaskDeleteController;
use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGenerator;

class TaskDeleteControllerTest extends WebTestCase
{

    public function testDeleteActionTest()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin@admin.fr',
            'PHP_AUTH_PW'   => 'admin',
        ]);
        $client->request('GET', '/tasks/119/delete');

        $crawler = $client->followRedirect();

        $this->assertSame(1, $crawler->filter('html:contains("La tâche a bien été supprimée.")')->count());
        $this->assertSame(200, $client->getResponse()->getStatusCode());


    }
}