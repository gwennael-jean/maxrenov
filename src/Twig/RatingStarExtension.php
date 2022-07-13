<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class RatingStarExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('rating_star', [$this, 'ratingStar'], ['is_safe' => ['html']]),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('rating_star', [$this, 'ratingStar'], ['is_safe' => ['html']]),
        ];
    }

    public function ratingStar(float $rating, int $count): string
    {
        $html = [];
        for ($i = 1; $i <= $count; $i++) {

            if ($rating >= $i) {
                $html[] = '<i class="fa-solid fa-fw fa-star"></i>';
            } else if ($rating >= $i - .5) {
                $html[] = '<i class="fa-solid fa-fw fa-star-half"></i>';
            }
        }

        return implode('', $html);
    }
}
