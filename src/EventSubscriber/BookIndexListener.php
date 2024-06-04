<?php

namespace App\EventSubscriber;

use App\Entity\Book\Book;
use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;
use Sylius\Bundle\ResourceBundle\Grid\View\ResourceGridView;
use Sylius\Component\Locale\Context\LocaleContextInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class BookIndexListener implements EventSubscriberInterface
{
    public function __construct(private readonly LocaleContextInterface $localeContext)
    {
    }

    public function onIndex(ResourceControllerEvent $event): void
    {
        $grid = $event->getSubject();

        if (!$grid instanceof ResourceGridView) {
            return;
        }

        $data = $grid->getData();

        /** @var Book $item */
        foreach ($data as $item) {
            $item->setCurrentLocale($this->localeContext->getLocaleCode());
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'app.book.index' => 'onIndex',
        ];
    }
}
