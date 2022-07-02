<?php

namespace App\Controller\Admin;

use App\Form\Parameter\MainParameterType;
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

    #[Route('/admin/parameters', name: 'app_admin_parameters_index')]
    public function index(Request $request)
    {
        $data = $this->parameterStorage->getByDomain('default');

        $form = $this->createForm(MainParameterType::class, $data);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->parameterStorage->save('default', $form->getData());

            $this->addFlash('success', 'Successfully saved parameters');
            return $this->redirect($this->adminUrlGenerator->setRoute('app_admin_parameters_index')->generateUrl());
        }

        return $this->render('admin/parameters.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
