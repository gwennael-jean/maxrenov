<?php

namespace App\Service\GoogleReview\Model;

class GoogleReview
{
    private Result $result;

    private ?int $countReview = null;

    private ?float $ratingAverage = null;

    public function __construct()
    {
        $this->result = new Result();
    }

    public function getResult(): Result
    {
        return $this->result;
    }

    public function getCountReview(): int
    {
        if (null === $this->countReview) {
            $this->countReview = count($this->getResult()->getReviews());
        }

        return $this->countReview;
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

    public function getIconStar(int $number): string
    {
        if ($this->getRatingAverage() >= $number) {
            return '<i class="fa-solid fa-fw fa-star"></i>';
        } else if ($this->getRatingAverage() >= $number - .5) {
            return '<i class="fa-solid fa-fw fa-star-half"></i>';
        }
        return '';
    }
}
