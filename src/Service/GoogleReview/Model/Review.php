<?php

namespace App\Service\GoogleReview\Model;

class Review
{
    private string $authorName;

    private string $authorUrl;

    private string $language;

    private string $profilePhotoUrl;

    private float $rating;

    private string $relativeTimeDescription;

    private string $text;

    private int $time;

    public function getAuthorName(): string
    {
        return $this->authorName;
    }

    public function setAuthorName(string $authorName): Review
    {
        $this->authorName = $authorName;

        return $this;
    }

    public function getAuthorUrl(): string
    {
        return $this->authorUrl;
    }

    public function setAuthorUrl(string $authorUrl): Review
    {
        $this->authorUrl = $authorUrl;

        return $this;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function setLanguage(string $language): Review
    {
        $this->language = $language;

        return $this;
    }

    public function getProfilePhotoUrl(): string
    {
        return $this->profilePhotoUrl;
    }

    public function setProfilePhotoUrl(string $profilePhotoUrl): Review
    {
        $this->profilePhotoUrl = $profilePhotoUrl;

        return $this;
    }

    public function getRating(): float
    {
        return $this->rating;
    }

    public function setRating(float $rating): Review
    {
        $this->rating = $rating;

        return $this;
    }

    public function getRelativeTimeDescription(): string
    {
        return $this->relativeTimeDescription;
    }

    public function setRelativeTimeDescription(string $relativeTimeDescription): Review
    {
        $this->relativeTimeDescription = $relativeTimeDescription;

        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): Review
    {
        $this->text = $text;

        return $this;
    }

    public function getTime(): int
    {
        return $this->time;
    }

    public function setTime(int $time): Review
    {
        $this->time = $time;

        return $this;
    }
}
