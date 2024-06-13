<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Organisation\Project;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait ProjectsAwareTrait
{
    public function initializeProjectsCollection(): void
    {
        $this->projects = new ArrayCollection();
    }

    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function setProjects(Collection $projects): void
    {
        $this->projects = $projects;
    }

    public function addProject(?Project $project = null): void
    {
        if (!$this->hasProject($project)) {
            $this->projects->add($project);
        }
    }
    public function hasProject(?Project $project = null): bool
    {
        return $this->projects->contains($project);
    }

    public function removeProject(?Project $project = null): void
    {
        if ($this->hasProject($project)) {
            $this->projects->removeElement($project);
        }
    }
}