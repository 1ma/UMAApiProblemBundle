<?php

namespace UMA\ApiProblemBundle\EventListener;

use Crell\ApiProblem\ApiProblem;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ApiProblemListener implements EventSubscriberInterface
{
    /**
     * @var int
     */
    private $defaultStatus;

    /**
     * @param int $defaultStatus
     */
    public function __construct($defaultStatus)
    {
        $this->defaultStatus = $defaultStatus;
    }

    /**
     * @param GetResponseForControllerResultEvent $event
     */
    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $apiProblem = $event->getControllerResult();

        if (!$apiProblem instanceof ApiProblem) {
            return;
        }

        $statusCode = 0 === $apiProblem->getStatus() ?
            $this->defaultStatus : $apiProblem->getStatus();

        $event->setResponse(
            new JsonResponse(
                $apiProblem->asArray(),
                $statusCode,
                ['Content-Type' => 'application/problem+json']
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [KernelEvents::VIEW => 'onKernelView'];
    }
}
