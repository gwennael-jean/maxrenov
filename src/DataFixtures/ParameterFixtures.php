<?php

namespace App\DataFixtures;

use App\Entity\Gallery;
use App\Entity\Parameter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ParameterFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $this->saveDefaultParameters($manager);
        $this->saveContactParameters($manager);
        $this->saveReseauSociauxParameters($manager);

        $manager->flush();
    }

    protected function saveDefaultParameters(ObjectManager $manager): void
    {
        $gallery = $manager->getRepository(Gallery::class)->findOneByTitle('Home');

        if (null !== $gallery) {
            $parameter = (new Parameter())
                ->setDomain('default')
                ->setName('homeGallery')
                ->setValue($gallery->getId());

            $manager->persist($parameter);
        }
    }

    protected function saveContactParameters(ObjectManager $manager): void
    {
        $manager->persist((new Parameter())
            ->setDomain('contact')
            ->setName('mail')
            ->setValue('maxrenov76@outlook.fr'));

        $manager->persist((new Parameter())
            ->setDomain('contact')
            ->setName('tel')
            ->setValue('07.61.43.52.52'));
    }

    protected function saveReseauSociauxParameters(ObjectManager $manager): void
    {
        $manager->persist((new Parameter())
            ->setDomain('reseau_social')
            ->setName('twitter')
            ->setValue(null));

        $manager->persist((new Parameter())
            ->setDomain('reseau_social')
            ->setName('facebook')
            ->setValue('Maxrenov-104385878487047'));

        $manager->persist((new Parameter())
            ->setDomain('reseau_social')
            ->setName('instagram')
            ->setValue(null));
    }

    public function getDependencies(): array
    {
        return [
            GalleryFixtures::class,
        ];
    }
}
