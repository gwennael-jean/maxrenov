<?php

namespace App\Twig\Component;

use App\Service\GoogleReview\GoogleReviewProvider;
use App\Service\GoogleReview\Model\GoogleReview;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('google-review', template: '.components/google-review.html.twig')]
class GoogleReviewComponent
{
    public ?GoogleReview $googleReview;

    public function __construct(GoogleReviewProvider $googleReviewProvider)
    {
        $this->googleReview = $googleReviewProvider->getData();
    }
}
