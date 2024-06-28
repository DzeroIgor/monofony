<?php

declare(strict_types=1);

namespace App\Entity\Project\Traits;

use App\Entity\Project\ProjectInterface;
use Doctrine\ORM\Mapping as ORM;

trait ProjectAwareTrait
{
    #[ORM\ManyToOne(targetEntity: ProjectInterface::class, cascade: ['persist'])]
    #[ORM\JoinColumn(name: 'project_id', referencedColumnName: 'id', nullable: true)]
    protected ?ProjectInterface $project = null;

    public function getProject(): ?ProjectInterface
    {
        return $this->project;
    }

    public function setProject(?ProjectInterface $project): void
    {
        $this->project = $project;
    }
}
