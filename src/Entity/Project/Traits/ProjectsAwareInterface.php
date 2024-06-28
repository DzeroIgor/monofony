<?php

namespace App\Entity\Project\Traits;

use App\Entity\Project\ProjectInterface;
use Doctrine\Common\Collections\Collection;

interface ProjectsAwareInterface
{
    public function initializeProjectsCollection(): void;

    public function getProjects(): Collection;

    public function setProjects(Collection $projects): void;

    public function addProject(?ProjectInterface $project = null): void;

    public function hasProject(?ProjectInterface $project = null): bool;

    public function removeProject(?ProjectInterface $project = null): void;
}
