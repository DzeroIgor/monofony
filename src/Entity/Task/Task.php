<?php

declare(strict_types=1);

namespace App\Entity\Task;

use App\Entity\Organisation\OrganisationInterface;
use App\Entity\Organisation\Traits\AssigneeOrganisationMembershipsAwareTrait;
use App\Entity\Organisation\Traits\AuthorOrganisationMembershipsAwareTrait;
use App\Entity\Project\Traits\ProjectAwareTrait;
use App\Entity\Traits\CodeAwareTrait;
use App\Entity\Traits\IdentifiableTrait;
use App\Entity\Traits\TimeSlotsAwareTrait;
use App\Entity\Traits\TimeStampTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\AssociationOverride;
use Doctrine\ORM\Mapping\JoinColumn;

#[ORM\Entity]
#[ORM\AssociationOverrides([
    new AssociationOverride(
        name: 'project',
        joinColumns: new JoinColumn(
            name: 'project_id',
            referencedColumnName: 'id',
            nullable: true,
            onDelete: 'CASCADE'
        ),
        inversedBy: 'tasks'
    ),
])]
#[ORM\Table(name: 'app_task')]
class Task implements TaskInterface
{
    use AssigneeOrganisationMembershipsAwareTrait;
    use AuthorOrganisationMembershipsAwareTrait;
    use TimeSlotsAwareTrait;
    use ProjectAwareTrait;
    use IdentifiableTrait;
    use CodeAwareTrait;
    use TimeStampTrait;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $name = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'string', enumType: TaskStatus::class, options: ['default' => TaskStatus::new])]
    private ?TaskStatus $status = TaskStatus::new;

    #[ORM\OneToMany(mappedBy: 'task', targetEntity: TimeSlotInterface::class, cascade: ['all'])]
    protected Collection $timeSlots;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $completedAt = null;

    public function __construct()
    {
        $this->initializeCode();
        $this->initializeTimeSlotsCollection();
    }

    public function getOrganisation(): ?OrganisationInterface
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

    public function addTimeSlot(?TimeSlotInterface $timeSlot = null): void
    {
        if (!$this->hasTimeSlot($timeSlot)) {
            $this->timeSlots->add($timeSlot);
            $timeSlot->setTask($this);
        }
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
