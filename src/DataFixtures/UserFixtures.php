<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $user1 = (new User())
            ->setEmail('super.admin@mail.test')
            ->setFirstname('Gwennael')
            ->setLastname('Jean')
            ->setPlainPassword('azerty')
            ->setIsAdmin(true);

        $user2 = (new User())
            ->setEmail('admin@mail.test')
            ->setFirstname('Maxime')
            ->setLastname('Pionnier')
            ->setPlainPassword('azerty')
            ->setIsAdmin(true);

         $manager->persist($user1);
         $manager->persist($user2);

        $manager->flush();
    }
}
