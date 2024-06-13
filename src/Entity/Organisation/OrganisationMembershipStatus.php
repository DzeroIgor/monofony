<?php

declare(strict_types=1);

namespace App\Entity\Organisation;

enum OrganisationMembershipStatus: string
{
    case New = 'New';
    case Pending = 'Pending';
    case Accepted = 'Accepted';
    case Denied = 'Denied';
    case Deleted = 'Deleted';
}
