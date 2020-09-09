<?php

namespace App\Action;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BaseActionAbstract
 *
 * @package App\Action
 */
abstract class BaseActionAbstract extends AbstractController implements ActionInterface
{
    /** @var string */
    const SERIALIZATION_GROUPS = 'serialization_groups';
    /** @var string */
    const SLUG_KEY = 'slug_key';

    /** @var array */
    protected array $options = [
        self::SERIALIZATION_GROUPS => ['default',],
        self::SLUG_KEY             => 'id',
    ];

    /**
     * @param string $name
     * @param $value
     *
     * @return BaseActionAbstract
     */
    public function setOption(string $name, $value): self
    {
        $this->options[$name] = $value;

        return $this;
    }

    /**
     * @param $data
     * @param array $context
     *
     * @return string
     */
    protected function serialize($data, array $context = []): string
    {
        $serializer = $this->get('serializer');

        $context['groups'] = $this->options[self::SERIALIZATION_GROUPS];

        return $serializer->serialize($data, 'json', $context);
    }

    /**
     * @return JsonResponse
     */
    protected function responseNotFound(): JsonResponse
    {
        return new JsonResponse([
            'message' => 'Not found'
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * @param $data
     * @param int $status
     *
     * @return JsonResponse
     */
    protected function response($data, int $status = Response::HTTP_OK): JsonResponse
    {
        if (Response::HTTP_OK === $status
            && empty($data)
        ) {
            return $this->responseNotFound();
        }

        if (is_array($data)) {
            $result = [
                'count' => count($data),
                'items' => $data,
            ];
        } else {
            $result = $data;
        }

        return new JsonResponse($this->serialize($result), $status, [], true);
    }
}
