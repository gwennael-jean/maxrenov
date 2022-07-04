<?php

namespace App\EventListener\Media;

use App\Entity\Media;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
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
        $this->checkUploadBinaryContent($media);
    }

    public function preUpdate(Media $media)
    {
        $this->checkUploadBinaryContent($media);
    }

    protected function checkUploadBinaryContent(Media $media)
    {
        if ($media->getBinaryContent() instanceof UploadedFile) {
            $this->handleUploadedFile($media);
        } else if ($media->getBinaryContent() instanceof File) {
            $this->handleFile($media);
        }
    }

    protected function handleUploadedFile(Media $media)
    {
        $file = $media->getBinaryContent();

        if ($file instanceof UploadedFile) {
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileExtension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

            $media
                ->setName($fileName)
                ->setPath($this->slugger->slug($fileName) . '.' . $fileExtension);

            $file->move($this->getDestPath($media), $media->getPath());
        }
    }

    protected function handleFile(Media $media)
    {
        $file = $media->getBinaryContent();

        if ($file instanceof File) {
            $filesystem = new Filesystem();

            $fileName = pathinfo($file->getFilename(), PATHINFO_FILENAME);
            $fileExtension = pathinfo($file->getFilename(), PATHINFO_EXTENSION);

            $media
                ->setName($fileName)
                ->setPath($this->slugger->slug($fileName) . '.' . $fileExtension);

            $filesystem->copy($file->getRealPath(), $this->getDestPath($media) . DIRECTORY_SEPARATOR . $media->getPath());
        }
    }

    protected function getDestPath(Media $media): string
    {
        $parameters = $this->parameterBag->get('media');

        return implode(DIRECTORY_SEPARATOR, [
            rtrim($parameters['path'], DIRECTORY_SEPARATOR),
            ltrim($parameters['context'][$media->getContext()]['path'], DIRECTORY_SEPARATOR),
        ]);
    }
}