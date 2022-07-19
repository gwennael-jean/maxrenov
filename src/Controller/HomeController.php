<?php

namespace App\Controller;

use App\Repository\ServiceRepository;
use App\Service\GalleryProvider;
use App\Service\ParameterStorage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'app_home')]
class HomeController extends AbstractController
{
    public function __invoke(
        ServiceRepository $serviceRepository,
        GalleryProvider $galleryProvider,
        ParameterStorage $parameterStorage
    ): Response
    {
        return $this->render('home/index.html.twig', [
            'jumbotron' => [
                'background' => $parameterStorage->get('homeJumbotronBackground'),
                'title' => $parameterStorage->get('homeJumbotronTitle'),
                'subtitle' => $parameterStorage->get('homeJumbotronSubtitle'),
            ],
            'services' => $serviceRepository->findAll(),
            'gallery' => $galleryProvider->findForHome(),
        ]);
    }
}
