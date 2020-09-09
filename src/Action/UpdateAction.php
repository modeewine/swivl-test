<?php

namespace App\Action;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UpdateAction
 *
 * @package App\Action
 */
class UpdateAction extends FormEntityActionAbstract
{
    protected function configureOptions(): void
    {
        $this->options[self::HTTP_METHOD] = Request::METHOD_PATCH;
    }

    /**
     * @param Request $request
     *
     * @return Response
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function executeAction(Request $request): Response
    {
        $result = $this->provideEntities($request);

        if (empty($result)) {
            return $this->responseNotFound();
        }

        $entity = reset($result);

        if (!$this->processSubmit($request, $entity, $validationData)) {
            return new JsonResponse($validationData, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return $this->response($entity);
    }
}
