<?php


namespace App\Tests\Controller;

use App\Controller\DefaultController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class DefaultControllerTest extends WebTestCase
{
    /** @var Environment $twig */
    private $twig;

    public function setUp()
    {
        $this->twig = $this->createMock(Environment::class);
    }

    public function testHomepageIsUp()
    {

        $controller = new DefaultController($this->twig);

        $this->assertInstanceOf(Response::class, $controller->indexAction());


    }


}