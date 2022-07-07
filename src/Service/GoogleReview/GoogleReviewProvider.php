<?php

namespace App\Service\GoogleReview;

use App\Service\GoogleReview\Model\GoogleReview;
use App\Service\GoogleReview\Normalizer\GoogleReviewNormalizer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GoogleReviewProvider
{
    private Serializer $serializer;

    private ?string $apiKey;

    private ?string $placeId;

    private const URL = "https://maps.googleapis.com/maps/api/place/details/json?key=%s&placeid=%s";

    public function __construct(private HttpClientInterface $client)
    {
        $this->serializer = new Serializer([new GoogleReviewNormalizer()], [new JsonEncoder()]);
        $this->apiKey = 'AIzaSyAJ7NZEpSyXlgn-qMEqgo5FwTgv3m5JvXk';
        $this->placeId = 'ChIJkZ97ULz54EcRK0zK1Tk9BeY';
    }

    public function getData(): ?GoogleReview
    {
        $response = $this->client->request(Request::METHOD_GET, sprintf(self::URL, $this->apiKey, $this->placeId));

        return Response::HTTP_OK === $response->getStatusCode()
            ? $this->serializer->deserialize($response->getContent(), GoogleReview::class, 'json')
            : null;
    }
}