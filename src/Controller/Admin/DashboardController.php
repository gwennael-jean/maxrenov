<?php

namespace App\Controller\Admin;

use App\Entity\Gallery;
use App\Entity\Media;
use App\Entity\Node\Page;
use App\Entity\Service;
use App\Entity\User;
use App\Repository\Node\PageRepository;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private UserRepository $userRepository,
        private PageRepository $pageRepository,
    )
    {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig', [
            'count' => [
                'users' => $this->userRepository->countAll(),
                'pages' => $this->pageRepository->countAll(),
            ]
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle("Max'Renov")
            ->renderContentMaximized()
            ->generateRelativeUrls();
    }

    public function configureAssets(): Assets
    {
        return Assets::new()
            ->addWebpackEncoreEntry('admin');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Users');
        yield MenuItem::linkToCrud('User List', 'fas fa-users', User::class);

        yield MenuItem::section('Content');
        yield MenuItem::linkToCrud('Page List', 'fas fa-file-lines', Page::class);
        yield MenuItem::linkToCrud('Service List', 'fa-solid fa-person-digging', Service::class);

        yield MenuItem::section('Media');
        yield MenuItem::linkToCrud('Media List', 'fa-solid fa-image', Media::class);
        yield MenuItem::linkToCrud('Gallery List', 'fa-solid fa-images', Gallery::class);

        yield MenuItem::section('Parameters');

        yield MenuItem::subMenu('Parameters', 'fa-solid fa-cogs')->setSubItems([
            MenuItem::linkToRoute('Main', null, 'app_admin_parameters_default'),
            MenuItem::linkToRoute('Topbar', null, 'app_admin_parameters_topbar'),
            MenuItem::linkToRoute('Contact', null, 'app_admin_parameters_contact'),
            MenuItem::linkToRoute('Social Networks', null, 'app_admin_parameters_rs'),
            MenuItem::linkToRoute('Google Review', null, 'app_admin_parameters_google_review'),
        ]);
    }
}