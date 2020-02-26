<?php

namespace App\Handler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;
use Twig\Environment;

class AccessDeniedHandler implements AccessDeniedHandlerInterface
{
    /**
     * @var Environment
     */
    private $twig;


    /**
     * AccessDeniedHandler constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }


    public function handle(Request $request, AccessDeniedException $accessDeniedException)
    {
        throw new \Symfony\Component\Finder\Exception\AccessDeniedException();
        //$request->getSession()->getFlashBag()->add('notice', 'Vous devez être connecté. Connectez-vous ou créez un compte');

        return $this->twig->render(':security:login.html.twig');
    }
}