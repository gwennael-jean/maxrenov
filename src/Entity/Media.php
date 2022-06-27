<?php

namespace App\Entity;

use App\EventListener\Media\UploadListener;
use App\Repository\MediaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
#[ORM\EntityListeners([UploadListener::class])]
class Media
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 50)]
    private ?string $context = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string  $name = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string  $path = null;

    private ?File $binaryContent;

    public function __construct()
    {
        $this->context = 'default';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContext(): ?string
    {
        return $this->context;
    }

    public function setContext(string $context): self
    {
        $this->context = $context;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getBinaryContent(): ?File
    {
        return $this->binaryContent;
    }

    public function setBinaryContent(?File $binaryContent): self
    {
        $this->binaryContent = $binaryContent;
        $this->name = null;

        return $this;
    }
}
