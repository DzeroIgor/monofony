<?php

namespace App\Entity\Organisation;

use App\Entity\CodeAwareTrait;
use App\Entity\IdentifiableTrait;
use App\Entity\MembersAwareTrait;
use App\Entity\ProjectsAwareTrait;
use App\Entity\TimeStampTrait;
use App\Entity\ToggleableTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Customer\Model\CustomerInterface;

#[ORM\Entity]
#[ORM\Table(name: 'app_organisation')]
class Organisation implements OrganisationInterface
{
    use IdentifiableTrait;

    use CodeAwareTrait;

    use ToggleableTrait;

    use TimeStampTrait;

    use ProjectsAwareTrait;

    use MembersAwareTrait;

    #[ORM\Column(type: 'string')]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'organisation', targetEntity: Project::class, cascade: ['all'])]
    protected Collection $projects;

    #[ORM\OneToMany(mappedBy: 'organisation', targetEntity: OrganisationMembership::class, cascade: ['all'])]
    protected Collection $members;

    public function __construct()
    {
        $this->initializeProjectsCollection();
        $this->initializeMembersCollection();
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

    public function getCustomerMember(?CustomerInterface $customer): ?OrganisationMembership
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
