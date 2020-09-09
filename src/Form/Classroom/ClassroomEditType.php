<?php

namespace App\Form\Classroom;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class ClassroomEditType
 *
 * @package App\Form\Classroom
 */
class ClassroomEditType extends ClassroomType
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
            ->remove('active')
        ;
    }
}
