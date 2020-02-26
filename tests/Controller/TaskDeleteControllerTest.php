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

class TaskDeleteControllerTest extends KernelTestCase
{
    private $em;
    /** @var UrlGenerator */
    private $urlGenerator;
    private $sessionInterface;

    public function setUp()
    {
        static::bootKernel();
        $this->em = static::$kernel->getContainer()->get('doctrine.orm.entity_manager');
        $this->urlGenerator = static::$kernel->getContainer()->get('router');
        $this->sessionInterface = static::$kernel->getContainer()->get('session');
    }

    public function testDeleteActionTest()
    {
        //$client = static::createClient();
        $controller = new TaskDeleteController($this->em, $this->urlGenerator, $this->sessionInterface);

        self::assertInstanceOf(RedirectResponse::class, $controller->deleteTaskAction(74));


    }
}