<?php

declare(strict_types=1);

namespace App\Entity\Organisation;

use App\Entity\CodeAwareTrait;
use App\Entity\IdentifiableTrait;
use App\Entity\TimeSlotsAwareTrait;
use App\Entity\TimeStampTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'app_task')]
class Task implements TaskInterface
{
    use IdentifiableTrait;

    use CodeAwareTrait;

    use TimeStampTrait;

    use TimeSlotsAwareTrait;

    #[ORM\ManyToOne(targetEntity: Project::class, cascade: ['all'], inversedBy: 'tasks')]
    private ?Project $project = null;

    #[ORM\Column(type: 'string')]
    private ?string $name = null;

    #[ORM\Column(type: 'string')]
    private ?string $description = null;

    #[ORM\Column(type: 'string', enumType: TaskStatus::class, options: ['default' => TaskStatus::new])]
    private ?TaskStatus $status = TaskStatus::new;

    #[ORM\OneToMany(mappedBy: 'task', targetEntity: TimeSlot::class, cascade: ['all'])]
    protected Collection $timeSlots;

    #[ORM\ManyToOne(targetEntity: OrganisationMembership::class)]
    private ?OrganisationMembership $author = null;

    #[ORM\ManyToOne(targetEntity: OrganisationMembership::class)]
    private ?OrganisationMembership $assignee = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $completedAt = null;

    public function __construct()
    {
        $this->initializeCode();
        $this->initializeTimeSlotsCollection();
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): void
    {
        $this->project = $project;
    }

    public function getOrganisation(): ?Organisation
    {
        return $this->getProject()?->getOrganisation();
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

    public function getStatus(): ?TaskStatus
    {
        return $this->status;
    }

    public function setStatus(?TaskStatus $status): void
    {
        $this->status = $status;
    }

    public function getAuthor(): ?OrganisationMembership
    {
        return $this->author;
    }

    public function setAuthor(?OrganisationMembership $author): void
    {
        $this->author = $author;
    }

    public function addTimeSlot(?TimeSlot $timeSlot = null): void
    {
        if (!$this->hasTimeSlot($timeSlot)) {
            $this->timeSlots->add($timeSlot);
            $timeSlot->setTask($this);
        }
    }

    public function getAssignee(): ?OrganisationMembership
    {
        return $this->assignee;
    }

    public function setAssignee(?OrganisationMembership $assignee): void
    {
        $this->assignee = $assignee;
    }

    public function getCompletedAt(): ?\DateTimeInterface
    {
        return $this->completedAt;
    }

    public function setCompletedAt(?\DateTimeInterface $completedAt): void
    {
        $this->completedAt = $completedAt;
    }

    public function getStateAsString(): string
    {
        return $this->status->value;
    }

    public function setStateAsString(string $stateAsString): Task
    {
        $this->status = TaskStatus::from($stateAsString);

        return $this;
    }

}