<?php

declare(strict_types=1);

namespace App\Entity\Organisation;

use App\Entity\CodeAwareInterface;
use App\Entity\TimeStampInterface;
use App\Entity\ToggleableInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

interface OrganisationInterface extends ResourceInterface, ToggleableInterface, TimeStampInterface, CodeAwareInterface
{
    public function getName(): ?string;

    public function setName(?string $name): void;
}