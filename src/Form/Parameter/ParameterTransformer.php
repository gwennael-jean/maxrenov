<?php

namespace App\Form\Parameter;

use App\Entity\Parameter;
use App\Repository\GalleryRepository;
use App\Service\ParameterStorage;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class ParameterTransformer implements DataTransformerInterface
{
    public function __construct(
        private KernelInterface       $kernel,
        private ParameterBagInterface $parameterBag,
        private SluggerInterface      $slugger,
        private GalleryRepository     $galleryRepository,
        private ParameterStorage      $parameterStorage,
    )
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
                case 'homeJumbotronBackground':
                case 'homeJumbotronTitleImage':
                    $data[$parameter->getName()] = null;
                    break;
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
                case 'homeJumbotronBackground':
                case 'homeJumbotronTitleImage':
                        $data[$key] = $value instanceof UploadedFile
                            ? $this->saveFile($key, $value)
                            : $this->parameterStorage->get($key);
                    break;
                case 'homeGallery':
                    $data[$key] = $value?->getId();
                    break;
            }
        }

        if (!!$data['removeHomeJumbotronTitleImage']) {
            $data['homeJumbotronTitleImage'] = null;
        }

        return $data;
    }

    private function saveFile(string $key, UploadedFile $file)
    {
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        $filepath = $this->slugger->slug($fileName).'-'.uniqid().'.'.$file->guessExtension();

        $file->move(rtrim($this->kernel->getProjectDir(), '/') . '/public/' . ltrim($this->parameterBag->get('public_file_upload_directory'), '/'), $filepath);

        return rtrim($this->parameterBag->get('public_file_upload_directory'), '/') . '/' . $filepath;
    }
}