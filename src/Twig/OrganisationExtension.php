<?php

declare(strict_types=1);

namespace App\Twig;

use Sylius\Component\Resource\Repository\RepositoryInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class OrganisationExtension extends AbstractExtension
{
    public function __construct(private readonly RepositoryInterface $organisationRepository)
    {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('app_get_organisation', [$this, 'getOrganisation']),
        ];
    }

    public function getOrganisation($organisationId)
    {
        return $this->organisationRepository->find($organisationId);
    }
}