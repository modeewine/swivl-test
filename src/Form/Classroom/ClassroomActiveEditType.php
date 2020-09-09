<?php

namespace App\Form\Classroom;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class ClassroomActiveEditType
 *
 * @package App\Form\Classroom
 */
class ClassroomActiveEditType extends ClassroomType
{
    /**
     * @param FormBuilderInterface $builder
     *
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->remove('name')
        ;
    }
}
