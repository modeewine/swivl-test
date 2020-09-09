<?php

namespace App\Action;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DeleteAction
 *
 * @package App\Action
 */
class DeleteAction extends EntityActionAbstract
{
    /**
     * @param object $entity
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    protected function processDelete(object $entity)
    {
        /** @var EntityManager $entityManager */
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($entity);
        $entityManager->flush($entity);
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

        $this->processDelete(reset($result));

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
