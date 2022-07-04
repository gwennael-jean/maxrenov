<?php

namespace App\DataFixtures;

use App\Entity\Gallery;
use App\Entity\Media;
use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class GalleryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach ($this->getData() as $data) {
            $gallery = (new Gallery())
                ->setTitle($data['title']);

            foreach ($data['medias'] as $media) {
                $gallery->addMedia((new Media())
                    ->setContext($media['context'])
                    ->setBinaryContent(new File($media['path']))
                );
            }

            $manager->persist($gallery);
        }

        $manager->flush();
    }

    private function getData(): array
    {
        return [
            [
                'title' => 'Home',
                'medias' => [
                    [
                        'context' => 'default',
                        'path' => __DIR__ . '/../../assets/images/1200x600/2-1200x600.jpg',
                    ],
                    [
                        'context' => 'default',
                        'path' => __DIR__ . '/../../assets/images/1200x600/40-1200x600.jpg',
                    ],
                    [
                        'context' => 'default',
                        'path' => __DIR__ . '/../../assets/images/1200x600/408-1200x600.jpg',
                    ],
                    [
                        'context' => 'default',
                        'path' => __DIR__ . '/../../assets/images/1200x600/648-1200x600.jpg',
                    ],
                ]
            ],
        ];
    }
}
