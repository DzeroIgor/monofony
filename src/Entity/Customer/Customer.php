<?php

declare(strict_types=1);

namespace App\Entity\Customer;

use App\Entity\MembersAwareTrait;
use App\Entity\Organisation\Organisation;
use App\Entity\Organisation\OrganisationMembership;
use App\Entity\User\AppUser;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Monofony\Contracts\Core\Model\Customer\CustomerInterface;
use Monofony\Contracts\Core\Model\User\AppUserInterface;
use Sylius\Component\Customer\Model\Customer as BaseCustomer;
use Sylius\Component\User\Model\UserInterface;
use Symfony\Component\Validator\Constraints\Valid;
use Webmozart\Assert\Assert;

#[ORM\Entity]
#[ORM\Table(name: 'sylius_customer')]
class Customer extends BaseCustomer implements CustomerInterface
{
    use MembersAwareTrait;

    #[ORM\OneToOne(mappedBy: 'customer', targetEntity: AppUser::class, cascade: ['persist'])]
    #[Valid]
    private ?UserInterface $user = null;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: OrganisationMembership::class)]
    protected Collection $members;

    public function __construct()
    {
        parent::__construct();

        $this->initializeMembersCollection();;
    }

    /**
     * {@inheritdoc}
     */
    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    /**
     * {@inheritdoc}
     */
    public function setUser(?UserInterface $user): void
    {
        if ($this->user === $user) {
            return;
        }

        Assert::nullOrIsInstanceOf($user, AppUserInterface::class);

        $previousUser = $this->user;
        $this->user = $user;

        if ($previousUser instanceof AppUserInterface) {
            $previousUser->setCustomer(null);
        }

        if ($user instanceof AppUserInterface) {
            $user->setCustomer($this);
        }
    }

    /** @return Organisation[] */
    public function getOrganisations(): array
    {
        $organisations = [];

        foreach ($this->getMembers() as $member) {
            $organisations[] = $member->getOrganisation();
        }

        return $organisations;
    }
}
