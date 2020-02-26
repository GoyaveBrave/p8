<?php

namespace App\Controller;
use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class TaskDeleteController
{
    /** @var EntityManagerInterface */
    private $em;
    /** @var UrlGeneratorInterface */
    private $urlGenerator;
    /** @var SessionInterface */
    private $sessionInterface;

    /**
     * TaskDeleteController constructor.
     * @param EntityManagerInterface $em
     * @param UrlGeneratorInterface $urlGenerator
     * @param SessionInterface $sessionInterface
     */
    public function __construct(EntityManagerInterface $em, UrlGeneratorInterface $urlGenerator, SessionInterface $sessionInterface)
    {
        $this->em = $em;
        $this->urlGenerator = $urlGenerator;
        $this->sessionInterface = $sessionInterface;
    }

    /**
     * @Route("/tasks/{id}/delete", name="task_delete")
     */
    public function deleteTaskAction($id): RedirectResponse
    {
        $task = $this->em->getRepository(Task::class)->find($id);
        $this->em->remove($task);
        $this->em->flush();

        $this->sessionInterface->getFlashBag()->add('success', 'La tâche a bien été supprimée.');

        return new RedirectResponse($this->urlGenerator->generate('task_list'));
    }
}