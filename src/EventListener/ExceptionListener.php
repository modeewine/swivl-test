<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class ExceptionListener
 *
 * @package App\EventListener
 */
class ExceptionListener
{
    /**
     * @param ExceptionEvent $event
     */
    public function onKernelException(ExceptionEvent $event)
    {
        $throwable = $event->getThrowable();

        $statusCode =
            $throwable instanceof HttpException
                ? $throwable->getStatusCode()
                : Response::HTTP_INTERNAL_SERVER_ERROR
        ;

        $response = new JsonResponse([
            'message' => $throwable->getMessage(),
        ], $statusCode);

        $event->setResponse($response);
    }
}
