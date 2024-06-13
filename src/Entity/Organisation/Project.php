<?php

declare(strict_types=1);

namespace App\Entity\Organisation;

use App\Entity\CodeAwareTrait;
use App\Entity\IdentifiableTrait;
use App\Entity\TimeStampTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'app_project')]
class Project implements ProjectInterface
{
    use IdentifiableTrait;

    use TimeStampTrait;

    use CodeAwareTrait;

    #[ORM\Column(type: 'string')]
    private ?string $name = null;

    #[ORM\Column(type: 'string')]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: Task::class, cascade: ['all'])]
    protected Collection $tasks;

    #[ORM\ManyToOne(targetEntity: Organisation::class, cascade: ['all'], inversedBy: 'projects')]
    private ?Organisation $organisation = null;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
        $this->initializeCode();
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

    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(?Task $task = null): void
    {
        if (!$this->hasTask($task)) {
            $this->tasks->add($task);
        }
    }
    public function hasTask(?Task $task = null): bool
    {
        return $this->tasks->contains($task);
    }

    public function removeTask(?Task $task = null): void
    {
        if ($this->hasTask($task)) {
            $this->tasks->removeElement($task);
        }
    }

    public function getOrganisation(): ?Organisation
    {
        return $this->organisation;
    }

    public function setOrganisation(?Organisation $organisation): void
    {
        $this->organisation = $organisation;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}