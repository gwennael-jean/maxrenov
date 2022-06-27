<?php

namespace App\Controller;

use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'app_home')]
class HomeController extends AbstractController
{
    public function __invoke(ServiceRepository $serviceRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'services' => $serviceRepository->findAll(),
        ]);
    }
}
