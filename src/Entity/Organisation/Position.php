<?php

declare(strict_types=1);

namespace App\Entity\Organisation;

enum Position: string
{
    case TeamLeader = 'Team Leader';
    case Frontend = 'Frontend';
    case Backend = 'Backend';
}
