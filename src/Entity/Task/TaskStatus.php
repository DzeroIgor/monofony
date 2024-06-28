<?php

declare(strict_types=1);

namespace App\Entity\Task;

enum TaskStatus: string
{
    case new = 'new';
    case pending_review = 'pending_review';
    case awaiting_changes = 'awaiting_changes';
    case accepted = 'accepted';
    case published = 'published';
    case rejected = 'rejected';
}
