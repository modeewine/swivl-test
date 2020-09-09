<?php

namespace App\Action;

use Doctrine\Common\Collections\Criteria;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class EntityActionAbstract
 *
 * @package App\Action
 */
abstract class EntityActionAbstract extends BaseActionAbstract
{
    /** @var string */
    protected string $entityClass;

    /**
     * EntityActionAbstract constructor.
     *
     * @param string $entityClass
     */
    public function __construct(string $entityClass)
    {
        $this->entityClass = $entityClass;
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    protected function buildEntityCriteria(Request $request): array
    {
        $key = $this->options[self::SLUG_KEY];

        return [$key => $request->get($key)];
    }

    /**
     * @param Criteria[] $criteria
     * @param array|null $orderBy
     * @param null $limit
     * @param null $offset
     *
     * @return object[]
     */
    protected function getEntities(array $criteria = [], array $orderBy = null, $limit = null, $offset = null)
    {
        $repository = $this->getDoctrine()->getRepository($this->entityClass);

        return $repository->findBy($criteria, $orderBy, $limit, $offset);

    }

    /**
     * @param Request $request
     *
     * @return object[]
     */
    protected function provideEntities(Request $request): array
    {
        return $this->getEntities($this->buildEntityCriteria($request));
    }
}
