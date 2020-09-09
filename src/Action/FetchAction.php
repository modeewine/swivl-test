<?php

namespace App\Action;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class FetchAction
 *
 * @package App\Action
 */
class FetchAction extends EntityActionAbstract
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function executeAction(Request $request): Response
    {
        $result = $this->provideEntities($request);

        return $this->response(reset($result));
    }
}
