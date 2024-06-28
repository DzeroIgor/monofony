<?php

declare(strict_types=1);

namespace App\Entity\Organisation\Traits;

use App\Entity\Organisation\OrganisationMembership;
use App\Entity\Organisation\OrganisationMembershipInterface;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Customer\Model\CustomerInterface;

trait AuthorOrganisationMembershipsAwareTrait
{
    #[ORM\ManyToOne(targetEntity: OrganisationMembershipInterface::class)]
    private ?OrganisationMembershipInterface $author = null;

    public function getAuthor(): ?OrganisationMembership
    {
        return $this->author;
    }

    public function setAuthor(?OrganisationMembership $author): void
    {
        $this->author = $author;
    }

    public function isAuthor(CustomerInterface $customer): bool
    {
        return $this->getAuthor()->getCustomer() === $customer;
    }
}
