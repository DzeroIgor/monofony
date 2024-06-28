<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use App\Context\CustomerContext;
use App\Entity\Task\Task;
use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class TaskSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly CustomerContext $customerContext)
    {
    }

    public static function getSubscribedEvents()
    {
        return [
//            'app.task.pre_create' => 'preCreate',
        ];
    }

    public function preCreate(ResourceControllerEvent $event): void
    {
        /** @var Task $task */
        $task = $event->getSubject();
        $organisation = $task->getOrganisation();

        if (null !== $organisation) {
            $member = $organisation->getCustomerMember($this->customerContext->getCustomer());

            $task->setAuthor($member);
        }
    }
}