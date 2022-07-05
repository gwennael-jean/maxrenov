<?php

namespace App\Form\Parameter;

use App\Entity\Parameter;
use App\Repository\GalleryRepository;
use Symfony\Component\Form\DataTransformerInterface;

class ParameterTransformer implements DataTransformerInterface
{
    public function __construct(private GalleryRepository $galleryRepository)
    {
    }

    /**
     * @param Parameter[] $parameters
     * @return array
     */
    public function transform($parameters)
    {
        $data = [];

        foreach ($parameters as $parameter) {
            switch ($parameter->getName()) {
                case 'homeGallery':
                    $data[$parameter->getName()] = null !== $parameter->getValue()
                        ? $this->galleryRepository->find($parameter->getValue())
                        : null;
                    break;
                default:
                    $data[$parameter->getName()] = $parameter->getValue();
                    break;
            }
        }

        return $data;
    }

    public function reverseTransform($data)
    {
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'homeGallery':
                    $data[$key] = $data[$key]?->getId();
                    break;
            }
        }

        return $data;
    }
}