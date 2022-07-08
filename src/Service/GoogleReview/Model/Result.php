<?php

namespace App\Service\GoogleReview\Model;

class Result
{
    /**
     * @var Review[]
     */
    private array $reviews;

    public function __construct()
    {
        $this->reviews = [];
    }

    /**
     * @return Review[]
     */
    public function getReviews(): array
    {
        return $this->reviews;
    }

    public function addReview(Review $review): self
    {
        $this->reviews[] = $review;

        return $this;
    }
}