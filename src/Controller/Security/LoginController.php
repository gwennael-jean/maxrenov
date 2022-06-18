<?php

namespace App\Controller\Security;

use App\Entity\User;
use App\Form\Security\LoginType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(Request $request, AuthenticationUtils $authenticationUtils, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LoginType::class, null, [
            'authenticationUtils' => $authenticationUtils
        ]);

        return $this->render('security/login.html.twig', [
            'form' => $form->createView(),
            'error' => $authenticationUtils->getLastAuthenticationError()
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
