<?php

declare(strict_types=1);

namespace App\Event;

use App\Service\Http\RequestLogger;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\KernelEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

/**
 * Subscriber to request/response events
 *
 * Class RequestSubscriber
 * @package App\Event
 */
class RequestSubscriber implements EventSubscriberInterface
{
    /**
     * RequestSubscriber constructor.
     */
    public function __construct(protected RequestLogger $logger)
    {
    }

    public static function getSubscribedEvents()
    {
        return [
            RequestEvent::class => [
                ['onRequestPre', -10],
            ],
            ResponseEvent::class => [
                ['onResponsePost', 10],
            ],
        ];
    }

    public function onRequestPre(RequestEvent $event): void
    {
        if (!$this->needLog($event)) {
            return;
        }

        $this->logger->logRequestInfo($event->getRequest());
    }

    public function onResponsePost(ResponseEvent $event): void
    {
        if (!$this->needLog($event)) {
            return;
        }

        $this->logger->logResponseInfo($event->getResponse());
    }

    /**
     * Check necessity to log request
     *
     * @param \Symfony\Component\HttpKernel\Event\KernelEvent $event
     *
     * @return bool
     */
    protected function needLog(KernelEvent $event): bool
    {
        return $event->isMainRequest();
    }
}