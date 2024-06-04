<?php

namespace App\Entity\Vehicle;

use App\Entity\IdentifiableTrait;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\ResourceInterface;

#[ORM\Entity]
#[ORM\Table(name: 'app_vehicle_category')]
class Category implements ResourceInterface
{
    use IdentifiableTrait;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
