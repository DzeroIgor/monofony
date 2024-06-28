<?php

declare(strict_types=1);

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

trait CodeAwareTrait
{
    #[ORM\Column(type: 'string')]
    protected ?string $code = null;

    public function initializeCode(): void
    {
        $this->code = Uuid::v4()->toRfc4122();
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): void
    {
        $this->code = $code;
    }
}
