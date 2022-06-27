<?php

namespace App\EventListener\Media;

use App\Entity\Media;
use App\Service\ImageManager;
use App\Service\Media\MediaProviderFactory;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class UploadListener
{
    public function __construct(
        private ParameterBagInterface $parameterBag,
        private SluggerInterface      $slugger,
    )
    {
    }

    public function prePersist(Media $media)
    {
        $this->uploadBinaryContent($media);
    }

    protected function uploadBinaryContent(Media $media)
    {
        $parameters = $this->parameterBag->get('media');

        $file = $media->getBinaryContent();

        if ($file instanceof UploadedFile) {
            $path = implode(DIRECTORY_SEPARATOR, [
                rtrim($parameters['path'], DIRECTORY_SEPARATOR),
                ltrim($parameters['context'][$media->getContext()]['path'], DIRECTORY_SEPARATOR),
            ]);

            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileExtension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

            $media
                ->setName($fileName)
                ->setPath($this->slugger->slug($fileName) . '.' . $fileExtension);

            $file->move($path, $media->getPath());
        }
    }
}