<?php

namespace App\Twig\Component\Jumbotron;

use Symfony\Component\HttpKernel\Kernel;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('jumbotron', template: '.components/jumbotrons/jumbotron.html.twig')]
class Jumbotron
{
    public ?string $image = null;

    public string $title;

    public ?string $subtitle = null;
}
