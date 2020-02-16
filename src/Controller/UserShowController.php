<?php

namespace App\Controller;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserShowController extends AbstractController
{
    /**
     * @Route("/users", name="user_list")
     */
    public function listAction()
    {
        return $this->render('user/list.html.twig', ['users' => $this->getDoctrine()->getRepository(User::class)->findAll()]);
    }
}