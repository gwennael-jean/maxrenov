<?php

declare(strict_types=1);

namespace App\EventListener\Service;

use App\Entity\Service;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class SluggableListener
{
    public function __construct(
        private SluggerInterface $slugger
    ) {
    }

    public function prePersist(Service $service, LifecycleEventArgs $event): void
    {
        $this->handle($service);
    }

    public function preUpdate(Service $service, PreUpdateEventArgs $event): void
    {
        $this->handle($service);
    }

    private function handle(Service $service): void
    {
        $slug = $this->slugger->slug($service->getTitle());
        $service->setSlug((string) $slug->lower());
    }
}
