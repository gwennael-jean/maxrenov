<?php

namespace App\DataFixtures;

use App\Entity\Gallery;
use App\Entity\Media;
use App\Entity\Parameter;
use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ParameterFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $gallery = $manager->getRepository(Gallery::class)->findOneByTitle('Home');

        if (null !== $gallery) {
            $parameter = (new Parameter())
                ->setDomain('default')
                ->setName('homeGallery')
                ->setValue($gallery->getId());

            $manager->persist($parameter);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            GalleryFixtures::class,
        ];
    }
}
