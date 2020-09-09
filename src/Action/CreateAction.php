<?php

namespace App\Action;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CreateAction
 *
 * @package App\Action
 */
class CreateAction extends FormEntityActionAbstract
{
    protected function configureOptions(): void
    {
        $this->options[self::HTTP_METHOD] = Request::METHOD_POST;
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
        $entityClass = $this->entityClass;
        $entity = new $entityClass();

        if (!$this->processSubmit($request, $entity, $validationData)) {
            return new JsonResponse($validationData, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return $this->response($entity);
    }
}
