<?php

namespace App\Entity\Organisation\Traits;

use App\Entity\Organisation\OrganisationInterface;

interface OrganisationAwareInterface
{
    public function getOrganisation(): ?OrganisationInterface;

    public function setOrganisation(?OrganisationInterface $organisation): void;
}