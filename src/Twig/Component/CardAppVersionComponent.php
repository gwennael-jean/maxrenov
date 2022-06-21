<?php

namespace App\Twig\Component;

use Symfony\Component\HttpKernel\Kernel;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('card-app-version', template: '.components/cards/card-app-version.html.twig')]
class CardAppVersionComponent
{
    public string $phpVersion = PHP_VERSION;

    public string $symfonyVersion = Kernel::VERSION;

    public string $symfonyEndOfMaintenance = Kernel::END_OF_MAINTENANCE;

    public string $symfonyEndOfLife = Kernel::END_OF_LIFE;
}
