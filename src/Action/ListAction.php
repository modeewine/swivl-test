<?php

namespace App\Action;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ListAction
 *
 * @package App\Action
 */
class ListAction extends EntityActionAbstract
{
    /**
     * @param Request $request
     *
     * @return array
     */
    protected function buildEntityCriteria(Request $request): array
    {
        return [];
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function executeAction(Request $request): Response
    {
        $result = $this->provideEntities($request);

        return $this->response($result);
    }
}
