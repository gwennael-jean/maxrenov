<?php

namespace App\Controller;

use App\Entity\Service;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    #[Route('/service/{id}', name: 'app_service')]
    public function index(Service $service): Response
    {
        return $this->render('service/index.html.twig', [
            'service' => $service,
        ]);
    }
}
