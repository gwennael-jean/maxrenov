<?php

namespace App\DataFixtures;

use App\Entity\Media;
use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\File;

class ServiceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach ($this->getData() as $data) {
            $service = (new Service())
                ->setTitle($data['title'])
                ->setIcon($data['icon'])
                ->setBody($data['body'])
                ->setDescription($data['description']);

            foreach ($data['medias'] as $media) {
                $service->addMedia((new Media())
                    ->setContext($media['context'])
                    ->setBinaryContent(new File($media['path']))
                );
            }

            $manager->persist($service);
        }

        $manager->flush();
    }

    private function getData(): array
    {
        return [
            [
                'title' => 'Électricité',
                'icon' => 'fas fa-bolt',
                'description' => ' Installation, dépannage et maintenance',
                'body' => 'His cognitis Gallus ut serpens adpetitus telo vel saxo iamque spes extremas opperiens et succurrens saluti suae quavis ratione colligi omnes iussit armatos et cum starent attoniti, districta dentium acie stridens adeste inquit viri fortes mihi periclitanti vobiscum.',
                'medias' => [
                    [
                        'context' => 'default',
                        'path' => __DIR__ . '/../../assets/images/800x600/185-800x600.jpg',
                    ],
                    [
                        'context' => 'default',
                        'path' => __DIR__ . '/../../assets/images/800x600/225-800x600.jpg',
                    ],
                    [
                        'context' => 'default',
                        'path' => __DIR__ . '/../../assets/images/800x600/307-800x600.jpg',
                    ],
                ]
            ],
            [
                'title' => 'Chauffage',
                'icon' => 'fa-solid fa-house-fire',
                'description' => 'Chauffage électrique et sèche serviette',
                'body' => 'His cognitis Gallus ut serpens adpetitus telo vel saxo iamque spes extremas opperiens et succurrens saluti suae quavis ratione colligi omnes iussit armatos et cum starent attoniti, districta dentium acie stridens adeste inquit viri fortes mihi periclitanti vobiscum.',
                'medias' => [
                    [
                        'context' => 'default',
                        'path' => __DIR__ . '/../../assets/images/800x600/334-800x600.jpg',
                    ],
                    [
                        'context' => 'default',
                        'path' => __DIR__ . '/../../assets/images/800x600/513-800x600.jpg',
                    ],
                    [
                        'context' => 'default',
                        'path' => __DIR__ . '/../../assets/images/800x600/696-800x600.jpg',
                    ],
                ]
            ],
            [
                'title' => 'Internet',
                'icon' => 'fa-solid fa-wifi',
                'description' => 'Câblage internet RJ45',
                'body' => 'His cognitis Gallus ut serpens adpetitus telo vel saxo iamque spes extremas opperiens et succurrens saluti suae quavis ratione colligi omnes iussit armatos et cum starent attoniti, districta dentium acie stridens adeste inquit viri fortes mihi periclitanti vobiscum.',
                'medias' => [
                    [
                        'context' => 'default',
                        'path' => __DIR__ . '/../../assets/images/800x600/785-800x600.jpg',
                    ],
                    [
                        'context' => 'default',
                        'path' => __DIR__ . '/../../assets/images/800x600/996-800x600.jpg',
                    ],
                ]
            ],
            [
                'title' => 'Téléphonie',
                'icon' => 'fa-solid fa-phone',
                'description' => 'Câblage téléphonique RJ11',
                'body' => 'His cognitis Gallus ut serpens adpetitus telo vel saxo iamque spes extremas opperiens et succurrens saluti suae quavis ratione colligi omnes iussit armatos et cum starent attoniti, districta dentium acie stridens adeste inquit viri fortes mihi periclitanti vobiscum.',
                'medias' => [
                    [
                        'context' => 'default',
                        'path' => __DIR__ . '/../../assets/images/800x600/185-800x600.jpg',
                    ],
                    [
                        'context' => 'default',
                        'path' => __DIR__ . '/../../assets/images/800x600/225-800x600.jpg',
                    ]
                ]
            ],
            [
                'title' => 'VMC',
                'icon' => 'fa-solid fa-wind',
                'description' => ' Installation et dépannage',
                'body' => 'His cognitis Gallus ut serpens adpetitus telo vel saxo iamque spes extremas opperiens et succurrens saluti suae quavis ratione colligi omnes iussit armatos et cum starent attoniti, districta dentium acie stridens adeste inquit viri fortes mihi periclitanti vobiscum.',
                'medias' => [
                    [
                        'context' => 'default',
                        'path' => __DIR__ . '/../../assets/images/800x600/307-800x600.jpg',
                    ],
                    [
                        'context' => 'default',
                        'path' => __DIR__ . '/../../assets/images/800x600/334-800x600.jpg',
                    ],
                    [
                        'context' => 'default',
                        'path' => __DIR__ . '/../../assets/images/800x600/513-800x600.jpg',
                    ],
                ]
            ],
        ];
    }
}
