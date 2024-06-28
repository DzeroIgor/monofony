<?php

declare(strict_types=1);

namespace App\Entity\Invoice;

use App\Entity\Organisation\Traits\OrganisationAwareTrait;
use App\Entity\Traits\IdentifiableTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'app_invoice')]
class Invoice implements InvoiceInterface
{
    use OrganisationAwareTrait;
    use IdentifiableTrait;

    #[ORM\Column(type: 'string')]
    private string $number;

    #[ORM\Column(type: 'string')]
    protected ?string $additional = null;

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