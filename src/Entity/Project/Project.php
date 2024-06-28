<?php

declare(strict_types=1);

namespace App\Entity\Project;

use App\Entity\Organisation\Traits\OrganisationAwareTrait;
use App\Entity\Task\TaskInterface;
use App\Entity\Task\Traits\TasksAwareTrait;
use App\Entity\Traits\CodeAwareTrait;
use App\Entity\Traits\IdentifiableTrait;
use App\Entity\Traits\TimeStampTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\AssociationOverride;
use Doctrine\ORM\Mapping\JoinColumn;

#[ORM\Entity]
#[ORM\AssociationOverrides([
    new AssociationOverride(
        name: 'organisation',
        joinColumns: new JoinColumn(
            name: 'organisation_id',
            referencedColumnName: 'id',
            nullable: true,
            onDelete: 'CASCADE'
        ),
        inversedBy: 'projects'
    ),
])]
#[ORM\Table(name: 'app_project')]
class Project implements ProjectInterface
{
    use OrganisationAwareTrait;
    use IdentifiableTrait;
    use TasksAwareTrait;
    use TimeStampTrait;
    use CodeAwareTrait;

    #[ORM\Column(type: 'string')]
    private ?string $name = null;

    #[ORM\Column(type: 'string')]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: TaskInterface::class, cascade: ['all'])]
    protected Collection $tasks;

    public function __construct()
    {
        $this->initializeTaskCollection();
        $this->initializeCode();
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
}
