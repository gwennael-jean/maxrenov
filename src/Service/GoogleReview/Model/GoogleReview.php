<?php

namespace App\Service\GoogleReview\Model;

class GoogleReview
{
    public Result $result;

    public ?float $ratingAverage = null;

    public function __construct()
    {
        $this->result = new Result();
    }

    public function getResult(): Result
    {
        return $this->result;
    }

    public function getRatingAverage(): float
    {
        if (null === $this->ratingAverage) {
            foreach ($this->result->getReviews() as $review) {
                $this->ratingAverage += $review->getRating();
            }

            $this->ratingAverage = $this->ratingAverage / count($this->getResult()->getReviews());
        }

        return $this->ratingAverage;
    }
}
