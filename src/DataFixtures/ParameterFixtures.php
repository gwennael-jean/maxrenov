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
        $this->saveSocialNetworksParameters($manager);
        $this->saveGoogleReviewParameters($manager);

        $manager->flush();
    }

    protected function saveDefaultParameters(ObjectManager $manager): void
    {
        $manager->persist((new Parameter())
            ->setDomain('default')
            ->setName('homeJumbotronBackground')
            ->setValue(null));

        $manager->persist((new Parameter())
            ->setDomain('default')
            ->setName('homeJumbotronTitle')
            ->setValue("Max'Renov"));

        $manager->persist((new Parameter())
            ->setDomain('default')
            ->setName('homeJumbotronSubtitle')
            ->setValue("Artisan Électricien"));

        $gallery = $manager->getRepository(Gallery::class)->findOneByTitle('Home');

        if (null !== $gallery) {
            $manager->persist((new Parameter())
                ->setDomain('default')
                ->setName('homeGallery')
                ->setValue($gallery->getId()));
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

    protected function saveSocialNetworksParameters(ObjectManager $manager): void
    {
        $manager->persist((new Parameter())
            ->setDomain('social_network')
            ->setName('twitter')
            ->setValue(null));

        $manager->persist((new Parameter())
            ->setDomain('social_network')
            ->setName('facebook')
            ->setValue('Maxrenov-104385878487047'));

        $manager->persist((new Parameter())
            ->setDomain('social_network')
            ->setName('instagram')
            ->setValue(null));
    }

    protected function saveGoogleReviewParameters(ObjectManager $manager): void
    {
        $manager->persist((new Parameter())
            ->setDomain('google_review')
            ->setName('googleReviewAPIKey')
            ->setValue(null));

        $manager->persist((new Parameter())
            ->setDomain('google_review')
            ->setName('googleReviewPlaceId')
            ->setValue('ChIJkZ97ULz54EcRK0zK1Tk9BeY'));
    }

    public function getDependencies(): array
    {
        return [
            GalleryFixtures::class,
        ];
    }
}
