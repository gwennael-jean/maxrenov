<?php

namespace App\Controller\Admin;

use App\Form\Parameter\ContactParameterType;
use App\Form\Parameter\GoogleReviewParameterType;
use App\Form\Parameter\MainParameterType;
use App\Form\Parameter\SocialNetworkParameterType;
use App\Service\ParameterStorage;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ParametersController extends AbstractController
{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator,
        private ParameterStorage $parameterStorage
    )
    {
    }

    #[Route('/admin/parameters/default', name: 'app_admin_parameters_default')]
    public function default(Request $request)
    {
        $data = $this->parameterStorage->getByDomain('default');

        $form = $this->createForm(MainParameterType::class, $data);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->parameterStorage->save('default', $form->getData());

            $this->addFlash('success', 'Successfully saved parameters');
            return $this->redirect($this->adminUrlGenerator->setRoute('app_admin_parameters_default')->generateUrl());
        }

        return $this->render('admin/parameters.html.twig', [
            'title' => "Main Parameters",
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/parameters/contact', name: 'app_admin_parameters_contact')]
    public function contact(Request $request)
    {
        $data = $this->parameterStorage->getByDomain('contact');

        $form = $this->createForm(ContactParameterType::class, $data);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->parameterStorage->save('contact', $form->getData());

            $this->addFlash('success', 'Successfully saved parameters');
            return $this->redirect($this->adminUrlGenerator->setRoute('app_admin_parameters_contact')->generateUrl());
        }

        return $this->render('admin/parameters.html.twig', [
            'title' => "Contact Parameters",
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/parameters/rs', name: 'app_admin_parameters_rs')]
    public function socialNetwork(Request $request)
    {
        $data = $this->parameterStorage->getByDomain('social_network');

        $form = $this->createForm(SocialNetworkParameterType::class, $data);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->parameterStorage->save('social_network', $form->getData());

            $this->addFlash('success', 'Successfully saved parameters');
            return $this->redirect($this->adminUrlGenerator->setRoute('app_admin_parameters_rs')->generateUrl());
        }

        return $this->render('admin/parameters.html.twig', [
            'title' => "Social Networks Parameters",
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/parameters/google-review', name: 'app_admin_parameters_google_review')]
    public function googleReview(Request $request)
    {
        $data = $this->parameterStorage->getByDomain('google_review');

        $form = $this->createForm(GoogleReviewParameterType::class, $data);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->parameterStorage->save('google_review', $form->getData());

            $this->addFlash('success', 'Successfully saved parameters');
            return $this->redirect($this->adminUrlGenerator->setRoute('app_admin_parameters_google_review')->generateUrl());
        }

        return $this->render('admin/parameters.html.twig', [
            'title' => "Google Review Parameters",
            'form' => $form->createView()
        ]);
    }
}
