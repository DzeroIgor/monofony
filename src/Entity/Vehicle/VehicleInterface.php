<?php

namespace App\Entity\Vehicle;

use App\Entity\Traits\ToggleableInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

interface VehicleInterface extends ResourceInterface, ToggleableInterface
{
    public function getVin(): ?string;

    public function setVin(?string $vin): void;

    public function getYear(): ?\DateTimeInterface;

    public function setYear(?\DateTimeInterface $year): void;

    public function getBrand(): ?Brand;

    public function setBrand(?Brand $brand): void;

    public function getModel(): ?Model;

    public function setModel(?Model $model): void;

    public function getCategory(): ?Category;

    public function setCategory(?Category $category): void;

    public function getWeight(): ?int;

    public function setWeight(?int $weight): void;

    public function getEngineVolume(): ?int;

    public function setEngineVolume(?int $engineVolume): void;

    public function getEngineNumber(): ?string;

    public function setEngineNumber(?string $engineNumber): void;

    public function getChassisNumber(): ?string;

    public function setChassisNumber(?string $chassisNumber): void;

    public function getState(): ?string;

    public function setState(?string $state): void;

    public function getHasAccident(): ?bool;

    public function setHasAccident(?bool $hasAccident): void;

    public function getColor(): ?Color;

    public function setColor(?Color $color): void;

    public function getEngineType(): ?EngineType;

    public function setEngineType(?EngineType $engineType): void;

    public function getNumberOfPlaces(): ?NumberOfPlaces;

    public function setNumberOfPlaces(?NumberOfPlaces $numberOfPlaces): void;

    public function getMeasurement(): ?Measurement;

    public function setMeasurement(?Measurement $measurement): void;

    public function getBodyType(): ?BodyType;

    public function setBodyType(?BodyType $bodyType): void;

    public function getNumberOfAccident(): int;

    public function addAccident(): void;

    public function getSize(): ?string;

    public function setSize(?string $size): void;
}