<?php

namespace App\Twig\Component\Navbar;

use App\Service\ParameterStorage;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('topbar', template: '.components/navbars/topbar.html.twig')]
class TopbarComponent
{
    public bool $scrollable = true;

    public ?string $logo = null;

    public ?string $title = null;

    public function __construct(ParameterStorage $parameterStorage)
    {
        $this->logo = $parameterStorage->get('topbarLogo');
        $this->title = $parameterStorage->get('topbarTitle');
    }
}
