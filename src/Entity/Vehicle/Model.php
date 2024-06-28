<?php

namespace App\Entity\Vehicle;

use App\Entity\Traits\IdentifiableTrait;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\ResourceInterface;

#[ORM\Entity]
#[ORM\Table(name: 'app_vehicle_model')]
class Model implements ResourceInterface
{
    use IdentifiableTrait;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(targetEntity: Brand::class, cascade: ['all'], inversedBy: 'models')]
    private ?Brand $brand = null;

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): void
    {
        $this->brand = $brand;
    }

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
