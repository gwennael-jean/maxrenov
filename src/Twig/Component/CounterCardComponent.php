<?php

namespace App\Twig\Component;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('counter-card', template: '.components/cards/counter-card.html.twig')]
class CounterCardComponent
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
