<?php

namespace App\Entity\Vehicle;

use App\Entity\IdentifiableTrait;
use App\Entity\ToggleableTrait;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\ResourceInterface;

#[ORM\Entity]
#[ORM\Table(name: 'app_vehicle')]
// #[ORM\UniqueConstraint(name: 'vin_inx', columns: ['vin'])]
class Vehicle implements VehicleInterface
{
    use IdentifiableTrait;

    use ToggleableTrait;

    #[ORM\Column(type: 'string')]
    private ?string $vin = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $year = null;

    #[ORM\ManyToOne(targetEntity: Brand::class)]
    private ?Brand $brand = null;

    #[ORM\ManyToOne(targetEntity: Model::class)]
    private ?Model $model = null;

    #[ORM\ManyToOne(targetEntity: Category::class)]
    private ?Category $category = null;

    #[ORM\Column(type: 'integer')]
    private ?int $weight = null;

    #[ORM\Column(type: 'string', enumType: Measurement::class)]
    private ?Measurement $measurement = null;

    #[ORM\Column(type: 'integer')]
    private ?int $engineVolume = null;

    #[ORM\Column(type: 'string')]
    private ?string $engineNumber = null;

    #[ORM\Column(type: 'string', enumType: BodyType::class)]
    private ?BodyType $bodyType = null;

    #[ORM\Column(type: 'string')]
    private ?string $chassisNumber = null;

    #[ORM\Column(type: 'string')]
    private ?string $state = 'new';

    #[ORM\Column(type: 'boolean')]
    private ?bool $hasAccident = false;

    #[ORM\Column(type: 'integer', options: ['default' => 0])]
    private int $numberOfAccident = 0;

    #[ORM\Column(type: 'string', enumType: Color::class)]
    private ?Color $color = null;

    #[ORM\Column(type: 'string', enumType: EngineType::class)]
    private ?EngineType $engineType = null;

    #[ORM\Column(type: 'string', enumType: NumberOfPlaces::class)]
    private ?NumberOfPlaces $numberOfPlaces = null;

    private ?string $size = null;

    public function getVin(): ?string
    {
        return $this->vin;
    }

    public function setVin(?string $vin): void
    {
        $this->vin = $vin;
    }

    public function getYear(): ?\DateTimeInterface
    {
        return $this->year;
    }

    public function setYear(?\DateTimeInterface $year): void
    {
        $this->year = $year;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): void
    {
        $this->brand = $brand;
    }

    public function getModel(): ?Model
    {
        return $this->model;
    }

    public function setModel(?Model $model): void
    {
        $this->model = $model;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): void
    {
        $this->category = $category;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(?int $weight): void
    {
        $this->weight = $weight;
    }

    public function getEngineVolume(): ?int
    {
        return $this->engineVolume;
    }

    public function setEngineVolume(?int $engineVolume): void
    {
        $this->engineVolume = $engineVolume;
    }

    public function getEngineNumber(): ?string
    {
        return $this->engineNumber;
    }

    public function setEngineNumber(?string $engineNumber): void
    {
        $this->engineNumber = $engineNumber;
    }

    public function getChassisNumber(): ?string
    {
        return $this->chassisNumber;
    }

    public function setChassisNumber(?string $chassisNumber): void
    {
        $this->chassisNumber = $chassisNumber;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): void
    {
        $this->state = $state;
    }

    public function getHasAccident(): ?bool
    {
        return $this->hasAccident;
    }

    public function setHasAccident(?bool $hasAccident): void
    {
        $this->hasAccident = $hasAccident;
    }

    public function getColor(): ?Color
    {
        return $this->color;
    }

    public function setColor(?Color $color): void
    {
        $this->color = $color;
    }

    public function getEngineType(): ?EngineType
    {
        return $this->engineType;
    }

    public function setEngineType(?EngineType $engineType): void
    {
        $this->engineType = $engineType;
    }

    public function getNumberOfPlaces(): ?NumberOfPlaces
    {
        return $this->numberOfPlaces;
    }

    public function setNumberOfPlaces(?NumberOfPlaces $numberOfPlaces): void
    {
        $this->numberOfPlaces = $numberOfPlaces;
    }

    public function getMeasurement(): ?Measurement
    {
        return $this->measurement;
    }

    public function setMeasurement(?Measurement $measurement): void
    {
        $this->measurement = $measurement;
    }

    public function getBodyType(): ?BodyType
    {
        return $this->bodyType;
    }

    public function setBodyType(?BodyType $bodyType): void
    {
        $this->bodyType = $bodyType;
    }

    public function getNumberOfAccident(): int
    {
        return $this->numberOfAccident;
    }

    public function addAccident(): void
    {
        ++$this->numberOfAccident;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(?string $size): void
    {
        $this->size = $size;
    }
}
