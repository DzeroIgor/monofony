<?php

declare(strict_types=1);

namespace App\Entity\Invoice;

use App\Entity\Organisation\Traits\OrganisationAwareInterface;

interface InvoiceInterface extends OrganisationAwareInterface
{
}