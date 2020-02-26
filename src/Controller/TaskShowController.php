<?php

namespace App\Controller;
use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class TaskShowController extends AbstractController
{
    /** @var Environment */
    private $twig;
    /** @var EntityManagerInterface */
    private $em;

    /**
     * TaskShowController constructor.
     * @param Environment $twig
     * @param EntityManagerInterface $em
     */
    public function __construct(Environment $twig, EntityManagerInterface $em)
    {
        $this->twig = $twig;
        $this->em = $em;
    }

    /**
     * @Route("/tasks", name="task_list")
     */
    public function listAction()
    {
        return new Response($this->twig->render('task/list.html.twig', ['tasks' => $this->em->getRepository(Task::class)->findAll(),
        'user' => $this->getUser()]));
    }
}