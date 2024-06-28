<?php

namespace App\Workflow\EventListener;

use App\Entity\Task\Task;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Workflow\Event\TransitionEvent;

class TaskStatusWorkflowEventListener implements EventSubscriberInterface
{
    public function onaApproveTransition(TransitionEvent $event): void
    {
        /** @var Task $task */
        $task = $event->getSubject();
        $task->setCompletedAt(new \DateTime());
    }

    public function onAskForChangeTransition(TransitionEvent $event): void
    {
        /** @var Task $task */
        $task = $event->getSubject();
        $task->setCompletedAt(null);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'workflow.app_task.transition.approve' => 'onaApproveTransition',
            'workflow.app_task.transition.ask_for_changes' => 'onAskForChangeTransition',
        ];
    }
}
