<?php

namespace App\Action;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface ActionInterface
 *
 * @package App\Action
 */
interface ActionInterface
{
    /**
     * @param string $name
     * @param $value
     *
     * @return $this
     */
    public function setOption(string $name, $value): self;

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function executeAction(Request $request): Response;
}
