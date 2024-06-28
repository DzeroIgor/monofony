<?php

namespace App\Entity;

use App\Entity\Vehicle\Model;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait ModelsAwareTrait
{
    protected Collection $models;

    public function initializeModelCollection(): void
    {
        $this->models = new ArrayCollection();
    }

    public function getModels(): Collection
    {
        return $this->models;
    }

    public function addModel(?Model $model = null): void
    {
        if (!$this->hasModel($model)) {
            $this->models->add($model);
        }
    }
    public function hasModel(?Model $model = null): bool
    {
        return $this->models->contains($model);
    }

    public function removeModel(?Model $model = null): void
    {
        if ($this->hasModel($model)) {
            $this->models->removeElement($model);
        }
    }
}