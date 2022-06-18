<?php

declare(strict_types=1);

namespace App\EventListener\User;

use App\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ChangePasswordListener
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function prePersist(User $user, LifecycleEventArgs $event): void
    {
        $this->changePassword($user);
    }

    public function preUpdate(User $user, PreUpdateEventArgs $event): void
    {
        $this->changePassword($user);
    }

    private function changePassword(User $user): void
    {
        if (null !== $user->getPlainPassword()) {
            $password = $this->passwordHasher->hashPassword($user, $user->getPlainPassword());
            $user->setPassword($password);
        }
    }
}
