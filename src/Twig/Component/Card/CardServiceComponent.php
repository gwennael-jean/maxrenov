<?php

namespace App\Twig\Component\Card;

use App\Service\ServerInformationProvider;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('card-service', template: '.components/cards/card-service.html.twig')]
class CardServiceComponent
{
    public ?string $icon = null;

    public ?string $title = null;

    public ?string $text = null;
}
