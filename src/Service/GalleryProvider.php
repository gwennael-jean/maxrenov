<?php

namespace App\Service;

use App\Entity\Gallery;
use App\Repository\GalleryRepository;

class GalleryProvider
{
    public function __construct(
        private ParameterStorage  $parameterStorage,
        private GalleryRepository $galleryRepository
    )
    {
    }

    public function findForHome(): ?Gallery
    {
        $galleriId = $this->parameterStorage->get('homeGallery');

        return $galleriId
            ? $this->galleryRepository->find($galleriId)
            : null;
    }
}