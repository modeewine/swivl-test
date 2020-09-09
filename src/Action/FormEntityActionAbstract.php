<?php

namespace App\Action;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Class FormEntityActionAbstract
 *
 * @package App\Action
 */
abstract class FormEntityActionAbstract extends EntityActionAbstract
{
    /** @var string */
    const HTTP_METHOD = 'http_method';

    /** @var string */
    protected string $formClass;

    /**
     * FormEntityActionAbstract constructor.
     *
     * @param string $entityClass
     * @param string $formClass
     */
    public function __construct(string $entityClass, string $formClass)
    {
        parent::__construct($entityClass);

        $this->formClass = $formClass;
    }

    abstract protected function configureOptions(): void;

    /**
     * @param object $entity
     * @param array $options
     *
     * @return Form
     */
    protected function buildForm(object $entity, array $options = []): Form
    {
        return $this->get('form.factory')
            ->createNamedBuilder('', $this->formClass, $entity, $options)
            ->getForm()
        ;
    }

    /**
     * @param Form $form
     * @return array
     */
    protected function getFormValidationData(Form $form): array
    {
        $initFormFieldsData = function (FormInterface $form, ?array &$data) use (&$initFormFieldsData) {
            if ($form->count()) {
                foreach ($form->all() as $fieldFormName => $fieldForm) {
                    $data[$fieldFormName] = null;
                    $initFormFieldsData($fieldForm, $data[$fieldFormName]);
                }
            } else {
                $data = [
                    'value'  => $form->getData(),
                    'valid'  => $form->isValid(),
                    'errors' => [],
                ];

                foreach ($form->getErrors() as $error) {
                    $data['errors'][] = $error->getMessage();
                }
            }
        };

        $formErrors = [];
        foreach ($form->getErrors() as $error) {
            $formErrors[] = $error->getMessage();
        }

        $initFormFieldsData($form, $formFieldsData);

        return [
            'valid'  => $form->isValid(),
            'errors' => $formErrors,
            'fields' => $formFieldsData,
        ];
    }

    /**
     * @param Request $request
     * @param object $entity
     * @param $validationData
     *
     * @return bool
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    protected function processSubmit(Request $request, object $entity, &$validationData): bool
    {
        $this->configureOptions();

        $options = [
            'method' => $this->options[self::HTTP_METHOD],
        ];

        $form = $this->buildForm($entity, $options);
        $form->handleRequest($request);

        if (!$form->isSubmitted()) {
            throw new BadRequestHttpException('Wrong request');
        }

        if (!$form->isValid()) {
            $validationData = $this->getFormValidationData($form);
            return false;
        }

        /** @var EntityManager $entityManager */
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($entity);
        $entityManager->flush($entity);

        return true;
    }
}
