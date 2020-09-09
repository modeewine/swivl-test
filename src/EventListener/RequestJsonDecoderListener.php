<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;

/**
 * Class RequestJsonDecoderListener
 *
 * @package App\EventListener
 */
class RequestJsonDecoderListener
{
    /**
     * @param RequestEvent $event
     */
    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();

        if (strtolower(trim($request->headers->get('Content-Type'))) !== 'application/json') {
            return;
        }

        $data = \json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : []);
    }
}
