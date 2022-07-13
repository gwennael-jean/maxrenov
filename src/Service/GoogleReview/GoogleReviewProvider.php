<?php

namespace App\Service\GoogleReview;

use App\Service\GoogleReview\Model\GoogleReview;
use App\Validator\GoogleReview as GoogleReviewConstraint;
use App\Service\GoogleReview\Normalizer\GoogleReviewNormalizer;
use App\Service\ParameterStorage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GoogleReviewProvider
{
    private Serializer $serializer;

    private ?string $apiKey;

    private ?string $placeId;

    private const URL = "https://maps.googleapis.com/maps/api/place/details/json?key=%s&placeid=%s&language=fr";

    public function __construct(
        private HttpClientInterface $client,
        private ValidatorInterface $validator,
        private ParameterStorage $parameterStorage
    )
    {
        $this->serializer = new Serializer([new GoogleReviewNormalizer()], [new JsonEncoder()]);
        $this->apiKey = $parameterStorage->get('googleReviewAPIKey');
        $this->placeId = $parameterStorage->get('googleReviewPlaceId');
    }

    public function getData(): ?GoogleReview
    {
        $response = $this->client->request(Request::METHOD_GET, $this->getUrl());

        if (Response::HTTP_OK === $response->getStatusCode()) {
            $googleReview = $this->serializer->deserialize($response->getContent(), GoogleReview::class, 'json');

            return $this->validator->validate($googleReview, new GoogleReviewConstraint())
                ? $googleReview
                : null;
        }
    }

    private function getUrl(): string
    {
        return sprintf(self::URL, $this->apiKey, $this->placeId);
    }
}