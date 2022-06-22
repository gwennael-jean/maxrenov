<?php

namespace App\Twig;

use App\Service\ByteFormater;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class ByteExtension extends AbstractExtension
{
    public function __construct(
        private ByteFormater $byteFormater
    )
    {
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('byte_format', [$this->byteFormater, 'format']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('byte_format', [$this->byteFormater, 'format']),
        ];
    }
}
