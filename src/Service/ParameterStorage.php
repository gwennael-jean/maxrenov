<?php

namespace App\Service;

use App\Repository\ParameterRepository;

class ParameterStorage
{
    public function __construct(private ParameterRepository $parameterRepository)
    {
    }

    public function getByDomain(string $domain): array
    {
        return $this->parameterRepository->findBy([
            'domain' => $domain
        ]);
    }

    public function get(string $name): ?string
    {
        $parameter = $this->parameterRepository->findOneBy([
            'name' => $name
        ]);

        return $parameter?->getValue();
    }

    public function set(string $domain, string $name, $value): void
    {
        $parameter = $this->parameterRepository->findOneBy([
            'domain' => $domain,
            'name' => $name,
        ]);

        null === $parameter
            ? $this->parameterRepository->insert($domain, $name, $value)
            : $this->parameterRepository->update($domain, $name, $value);
    }

    public function save(string $domain, array $values): void
    {
        foreach ($values as $name => $value) {
            $this->set($domain, $name, $value);
        }
    }
}