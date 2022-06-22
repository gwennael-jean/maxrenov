<?php

namespace App\Twig\Component\Jumbotron;

use Symfony\Component\HttpKernel\Kernel;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('home-jumbotron', template: '.components/jumbotrons/home-jumbotron.html.twig')]
class HomeJumbotron
{
}
