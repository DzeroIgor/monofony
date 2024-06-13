<?php

declare(strict_types=1);

namespace App\Twig;

use App\Context\OrganisationContext;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class OrganisationExtension extends AbstractExtension
{
    public function __construct(private readonly RepositoryInterface $organisationRepository, private readonly OrganisationContext $organisationContext)
    {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('app_get_organisation', [$this, 'getOrganisation']),
            new TwigFunction('app_get_current_organisation', [$this, 'getCurrentOrganisation']),
        ];
    }

    public function getOrganisation($organisationId)
    {
        return $this->organisationRepository->find($organisationId);
    }

    public function getCurrentOrganisation()
    {
        return $this->organisationContext->getOrganisation();
    }
}