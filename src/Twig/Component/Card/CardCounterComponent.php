<?php

namespace App\Twig\Component\Card;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('card-counter', template: '.components/cards/card-counter.html.twig')]
class CardCounterComponent
{
    public string $bgColor = 'primary';

    public string $textColor = 'white';

    public string $icon;

    public string $title;

    public int $value;

    public function getBackgroundColorClass(): string
    {
        return 'bg-' . $this->bgColor;
    }

    public function getTextColorClass(): string
    {
        return 'text-' . $this->textColor;
    }
}
