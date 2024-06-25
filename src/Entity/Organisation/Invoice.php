<?php

declare(strict_types=1);

namespace App\Entity\Organisation;

use App\Entity\IdentifiableTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'app_invoice')]
class Invoice implements InvoiceInterface
{
    use IdentifiableTrait;

    #[ORM\Column(type: 'string')]
    private string $number;

    #[ORM\Column(type: 'string')]
    protected ?string $additional = null;

    #[ORM\ManyToOne(targetEntity: Organisation::class)]
    private ?Organisation $organisation = null;

    #[ORM\Column(type: 'datetime')]
    protected ?\DateTimeInterface $billingData = null;

    #[ORM\Column(type: 'datetime')]
    protected ?\DateTimeInterface $dueDate = null;

    #[ORM\Column(type: 'datetime')]
    protected ?\DateTimeInterface $issuedAt = null;

    #[ORM\Column(type: 'integer')]
    private ?int $amount = null;

    #[ORM\Column(type: 'integer')]
    private ?int $total = null;

//    protected ?Money $amount = null;
}