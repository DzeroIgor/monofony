<?php

namespace App\Entity\Project\Traits;

use App\Entity\Project\ProjectInterface;

interface ProjectAwareInterface
{
    public function getProject(): ?ProjectInterface;

    public function setProject(?ProjectInterface $project): void;
}