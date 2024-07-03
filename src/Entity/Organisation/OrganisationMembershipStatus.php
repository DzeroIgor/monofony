<?php

declare(strict_types=1);

namespace App\Entity\Organisation;

enum OrganisationMembershipStatus: string
{
    case new = 'new';
    case pending = 'pending';
    case accepted = 'accepted';
    case denied = 'denied';
    case deleted = 'deleted';
}
