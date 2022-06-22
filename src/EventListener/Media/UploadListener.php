<?php

namespace App\EventListener\Media;

use App\Entity\Media;
use App\Service\ImageManager;
use App\Service\Media\MediaProviderFactory;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadListener
{
    public function prePersist(Media $media)
    {
        $this->uploadBinaryContent($media);
    }

    protected function uploadBinaryContent(Media $media)
    {
        // TODO upload file
    }
}