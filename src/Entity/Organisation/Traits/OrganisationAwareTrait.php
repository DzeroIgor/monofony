<?php

declare(strict_types=1);

namespace App\Entity\Organisation\Traits;

use App\Entity\Organisation\OrganisationInterface;
use Doctrine\ORM\Mapping as ORM;

trait OrganisationAwareTrait
{
    #[ORM\ManyToOne(targetEntity: OrganisationInterface::class, cascade: ['persist'])]
    #[ORM\JoinColumn(name: 'organisation_id', referencedColumnName: 'id', nullable: true)]
    protected ?OrganisationInterface $organisation = null;

    public function getOrganisation(): ?OrganisationInterface
    {
        return $this->organisation;
    }

    public function setOrganisation(?OrganisationInterface $organisation): void
    {
        $this->organisation = $organisation;
    }
}
