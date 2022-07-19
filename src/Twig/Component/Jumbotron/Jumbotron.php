<?php

namespace App\Twig\Component\Jumbotron;

use Symfony\Component\HttpKernel\Kernel;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('jumbotron', template: '.components/jumbotrons/jumbotron.html.twig')]
class Jumbotron
{
    public ?string $class = null;

    public ?string $background = null;

    public ?string $titleImage = null;

    public string $title;

    public ?string $subtitle = null;
}
