<?php

namespace App\Controller;
use App\Entity\Task;
use App\Form\TaskType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Security;
use Twig\Environment;

class TaskAddController
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

    /**
     * TaskAddController constructor.
     * @param EntityManagerInterface $em
     * @param Environment $twig
     * @param FormFactoryInterface $formFactory
     * @param Response $response
     * @param Security $security
     * @param UrlGeneratorInterface $urlGenerator
     * @param SessionInterface $sessionInterface
     */
    public function __construct(EntityManagerInterface $em, Environment $twig, FormFactoryInterface $formFactory, Security $security, UrlGeneratorInterface $urlGenerator, SessionInterface $sessionInterface)
    {
        $this->em = $em;
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->security = $security;
        $this->urlGenerator = $urlGenerator;
        $this->sessionInterface = $sessionInterface;
    }


    /**
     * @Route("/tasks/create", name="task_create")
     */
    public function createAction(Request $request)
    {
        $task = new Task();

        $user = $this->security->getUser();

        $form = $this->formFactory->create(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($user) {
                $task->setUserId($user);
            }

            $this->em->persist($task);
            $this->em->flush();

            $this->sessionInterface->getFlashBag()->add('success', 'La tâche a été bien été ajoutée.');

            return new RedirectResponse($this->urlGenerator->generate('task_list'));
        }

        return new Response($this->twig->render('task/create.html.twig', ['form' => $form->createView()]));
    }
}
