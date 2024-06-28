<?php

namespace App\Entity\Organisation;

use App\Entity\Organisation\Traits\OrganisationMembershipsAwareTrait;
use App\Entity\Project\ProjectInterface;
use App\Entity\Project\Traits\ProjectsAwareTrait;
use App\Entity\Traits\CodeAwareTrait;
use App\Entity\Traits\IdentifiableTrait;
use App\Entity\Traits\TimeStampTrait;
use App\Entity\Traits\ToggleableTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Customer\Model\CustomerInterface;

#[ORM\Entity]
#[ORM\Table(name: 'app_organisation')]
class Organisation implements OrganisationInterface
{
    use OrganisationMembershipsAwareTrait;
    use ProjectsAwareTrait;
    use IdentifiableTrait;
    use CodeAwareTrait;
    use ToggleableTrait;
    use TimeStampTrait;

    #[ORM\OneToMany(mappedBy: 'organisation', targetEntity: ProjectInterface::class, cascade: ['all'])]
    protected Collection $projects;

    #[ORM\OneToMany(mappedBy: 'organisation', targetEntity: OrganisationMembershipInterface::class, cascade: ['all'])]
    protected Collection $members;

    #[ORM\Column(type: 'string')]
    private ?string $name = null;

    public function __construct()
    {
        $this->initializeProjectsCollection();
        $this->initializeMemberCollection();
        $this->initializeCode();
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function isOwner(CustomerInterface $customer): bool
    {
        /** @var OrganisationMembershipInterface $member */
        foreach ($this->members as $member) {
            if ($member->isOwner($customer)) {
                return true;
            }
        }

        return false;
    }

    public function getCustomerMember(?CustomerInterface $customer): ?OrganisationMembershipInterface
    {
        foreach ($this->getMembers() as $member) {
            if ($member->getCustomer() === $customer) {
                return $member;
            }
        }

        return null;
    }

    /**
     * @return CustomerInterface[]
     */
    public function getCustomers(): array
    {
        $customers = [];

        foreach ($this->getMembers() as $member) {
            $customers[] = $member->getCustomer();
        }

        return $customers;
    }
}
