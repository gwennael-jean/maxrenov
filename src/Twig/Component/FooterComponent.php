<?php

namespace App\Twig\Component;

use App\Service\ParameterStorage;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('footer', template: '.components/footer.html.twig')]
class FooterComponent
{
    public ?string $mail;

    public ?string $tel;

    public ?string $twitter;

    public ?string $facebook;

    public ?string $instagram;

    public function __construct(
        private ParameterStorage $parameterStorage
    )
    {
        $this->mail = $parameterStorage->get('mail');
        $this->tel = $parameterStorage->get('tel');
        $this->twitter = $parameterStorage->get('twitter');
        $this->facebook = $parameterStorage->get('facebook');
        $this->instagram = $parameterStorage->get('instagram');
    }

    public function hasContact(): bool
    {
        return $this->mail || $this->tel;
    }

    public function hasReseauSocial(): bool
    {
        return $this->twitter || $this->facebook || $this->instagram;
    }
}
