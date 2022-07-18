<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class TelExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('format_tel', [$this, 'getFormatTel']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('format_tel', [$this, 'getFormatTel']),
        ];
    }

    public function getFormatTel(string $phone): string
    {
       return preg_replace('/[^\d]/', '', $phone);
    }
}
