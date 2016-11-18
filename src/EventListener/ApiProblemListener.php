<?php

namespace UMA\ApiProblemBundle\EventListener;

use Crell\ApiProblem\ApiProblem;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ApiProblemListener implements EventSubscriberInterface
{
    /**
     * @param GetResponseForControllerResultEvent $event
     */
    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $controllerResult = $event->getControllerResult();

        if (!$controllerResult instanceof ApiProblem) {
            return;
        }

        $statusCode = 0 === $controllerResult->getStatus() ?
            Response::HTTP_BAD_REQUEST : $controllerResult->getStatus();

        $event->setResponse(
            new JsonResponse(
                $controllerResult->asArray(),
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
