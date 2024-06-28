<?php

namespace App\Entity;

use App\Entity\Vehicle\Model;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

interface ModelsAwareInterface
{
    public function initializeModelCollection(): void;

    public function getModels(): Collection;

    public function addModel(?Model $model = null): void;

    public function hasModel(?Model $model = null): bool;

    public function removeModel(?Model $model = null): void;
}