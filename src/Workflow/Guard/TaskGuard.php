<?php

namespace App\Workflow\Guard;

use App\Context\CustomerContext;
use App\Entity\Task\Task;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Workflow\Event\GuardEvent;

class TaskGuard implements EventSubscriberInterface
{
    public function __construct(private readonly CustomerContext $customerContext)
    {
    }

    public function isAuthor(GuardEvent $guardEvent): void
    {
        /** @var Task $task */
        $task = $guardEvent->getSubject();
        if ($this->customerContext->getCustomer() !== $task->getAuthor()->getCustomer()) {
            $guardEvent->setBlocked(true);
        }
    }
    public function isAssignee(GuardEvent $guardEvent): void
    {
        /** @var Task $task */
        $task = $guardEvent->getSubject();
        if ($task->getAssignee() && $this->customerContext->getCustomer() !== $task->getAssignee()->getCustomer()) {
            $guardEvent->setBlocked(true);
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'workflow.app_task.guard.approve' => 'isAuthor',
            'workflow.app_task.guard.ask_for_changes' => 'isAuthor',
            'workflow.app_task.guard.create' => 'isAssignee',
            'workflow.app_task.guard.submit_changes' => 'isAssignee',
        ];
    }
}
