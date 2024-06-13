<?php

declare(strict_types=1);

namespace App\Entity\Organisation;

enum Role: string
{
    case ROLE_OWNER = 'ROLE_OWNER';
    case ROLE_MEMBER = 'ROLE_MEMBER';

    public function isOwner(): bool
    {
        return self::ROLE_OWNER === $this;
    }

    public function isMember(): bool
    {
        return self::ROLE_MEMBER === $this;
    }
}
