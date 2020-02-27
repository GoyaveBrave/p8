<?php

namespace App\Controller;
use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class TaskDeleteController extends AbstractController
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
        $user = $this->getUser();
        $task = $this->em->getRepository(Task::class)->find($id);


        if ($user === $task->getUserId() OR $task->getUserId() == null AND $user->getRoles()[0] == "ROLE_ADMIN") {
            $this->em->remove($task);
            $this->em->flush();
        }
        else {
            throw new AccessDeniedException('Vous n\'êtes pas autorisé à supprimer cette tâche');
        }

        $this->sessionInterface->getFlashBag()->add('success', 'La tâche a bien été supprimée.');

        return new RedirectResponse($this->urlGenerator->generate('task_list'));
    }
}