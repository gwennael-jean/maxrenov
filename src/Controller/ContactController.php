<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Service\ParameterStorage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer, ParameterStorage $parameterStorage): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        $parameterStorage->get('mail');

        if ($form->isSubmitted() && $form->isValid()) {
            $message = (new Email())
                ->from($form->get('email')->getData())
                ->to($parameterStorage->get('mail'))
                ->subject("Prise de contact")
                ->html($this->renderView('@email/contact.html.twig', [
                    'contact' => $form->getData(),
                ]));

            $mailer->send($message);

            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
