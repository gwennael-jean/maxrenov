<?php

namespace App\Twig\Component\Card;

use App\Service\ServerInformationProvider;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('card-server', template: '.components/cards/card-server.html.twig')]
class CardServerComponent
{
    public ?string $diskAvailableSpace = null;

    public ?string $diskTotalSpace = null;

    public ?string $percentAvailableSpace = null;

    public ?string $progressbarBackgroundColor = null;

    public ?string $databaseUsedSpace = null;

    public function __construct(ServerInformationProvider $serverInformationProvider)
    {
        $this->diskAvailableSpace = $serverInformationProvider->getAvailableSpace();
        $this->diskTotalSpace = $serverInformationProvider->getTotalSpace();
        $this->percentAvailableSpace = $serverInformationProvider->getPercentAvailableSpace();
        $this->databaseUsedSpace = $serverInformationProvider->getDatabaseUsedSpace();
        $this->progressbarBackgroundColor = $this->getProgressbarBackgroundColor();
    }

    private function getProgressbarBackgroundColor()
    {
        switch (true) {
            case $this->percentAvailableSpace > 90:
                return 'progress-bar-danger';
            case $this->percentAvailableSpace > 70:
                return 'progress-bar-warning';
            default:
                return 'progress-bar-info';
        }
    }
}
