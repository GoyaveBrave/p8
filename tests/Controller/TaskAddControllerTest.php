<?php

namespace App\Tests\Controller;
use App\Controller\TaskAddController;
use App\Form\TaskType;
use App\Repository\UserRepository;
use App\Security\LoginFormAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Security;
use Twig\Environment;

class TaskAddControllerTest extends KernelTestCase
{
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var Environment
     */
    private $twig;
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var Security
     */
    private $security;

    /** @var UrlGeneratorInterface */
    private $urlGenerator;
    /** @var SessionInterface */
    private $sessionInterface;

    public function setUp()
    {
        static::bootKernel();
        $this->twig = $this->createMock(Environment::class);
        $this->em = static::$kernel->getContainer()->get('doctrine.orm.entity_manager');
        $this->formFactory = static::$kernel->getContainer()->get('form.factory');
        $this->security = $this->createMock(Security::class);
        $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
        $this->sessionInterface = static::$kernel->getContainer()->get('session');

    }


    public function testCreateAction()
    {

        $controller = new TaskAddController($this->em, $this->twig, $this->formFactory, $this->security, $this->urlGenerator, $this->sessionInterface);
        $request = Request::create('/tasks/create', 'GET');
        $this->assertInstanceOf(Response::class, $controller->createAction($request));
        //Good response instanceof RedirectResponse

        //Bad task instanceof Response

    }
}