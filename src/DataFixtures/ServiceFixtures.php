<?php

namespace App\DataFixtures;

use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ServiceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach ($this->getData() as $data) {
            $user1 = (new Service())
                ->setTitle($data['title'])
                ->setIcon($data['icon'])
                ->setDescription($data['description']);

            $manager->persist($user1);
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
            ],
            [
                'title' => 'Chauffage',
                'icon' => 'fa-solid fa-house-fire',
                'description' => 'Chauffage électrique et sèche serviette',
            ],
            [
                'title' => 'Internet',
                'icon' => 'fa-solid fa-wifi',
                'description' => 'Câblage internet RJ45',
            ],
            [
                'title' => 'Téléphonie',
                'icon' => 'fa-solid fa-phone',
                'description' => 'Câblage téléphonique RJ11',
            ],
            [
                'title' => 'VMC',
                'icon' => 'fa-solid fa-wind',
                'description' => ' Installation et dépannage',
            ],
        ];
    }
}
