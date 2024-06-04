<?php

namespace App\Entity\Vehicle;

use App\Entity\IdentifiableTrait;
use App\Entity\ModelsAwareTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\ResourceInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity]
#[ORM\Table(name: 'app_vehicle_brand')]
class Brand implements ResourceInterface
{
    use IdentifiableTrait;

    use ModelsAwareTrait;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'brand', targetEntity: Model::class, cascade: ['all'])]
    protected Collection $models;

    public function __construct()
    {
        $this->initializeModelsCollection();
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function addModel(?Model $model = null): void
    {
        if (!$this->hasModel($model)) {
            $this->models->add($model);
            $model->setBrand($this);
        }
    }

    public function __toString()
    {
        return $this->getName();
    }
}
