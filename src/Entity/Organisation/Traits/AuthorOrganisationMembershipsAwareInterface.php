<?php

declare(strict_types=1);

namespace App\Entity\Organisation\Traits;

use App\Entity\Organisation\OrganisationMembership;
use Sylius\Component\Customer\Model\CustomerInterface;

interface AuthorOrganisationMembershipsAwareInterface
{
    public function getAuthor(): ?OrganisationMembership;

    public function setAuthor(?OrganisationMembership $author): void;

    public function isAuthor(CustomerInterface $customer): bool;
}
