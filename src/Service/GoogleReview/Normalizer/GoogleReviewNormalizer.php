<?php

namespace App\Service\GoogleReview\Normalizer;

use App\Service\GoogleReview\Model\GoogleReview;
use App\Service\GoogleReview\Model\Review;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class GoogleReviewNormalizer implements DenormalizerInterface
{
    public function supportsDenormalization(mixed $data, string $type, string $format = null)
    {
        return $type === GoogleReview::class && $format === 'json';
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = [])
    {
        $result = new GoogleReview();

        foreach ($data['result']['reviews'] as $reviewData) {
            $result->result->addReview((new Review())
                ->setAuthorName($reviewData['author_name'])
                ->setAuthorUrl($reviewData['author_url'])
                ->setLanguage($reviewData['language'])
                ->setProfilePhotoUrl($reviewData['profile_photo_url'])
                ->setRating($reviewData['rating'])
                ->setText($reviewData['text'])
                ->setTime($reviewData['time']));
        }

        return $result;
    }
}