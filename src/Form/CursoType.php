<?php

namespace App\Form;

use App\Entity\Curso;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CursoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome_curso')
            ->add('Coordinador')
            ->add('email')
            ->add('phone')
            ->add('anoLectivo')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Curso::class,
        ]);
    }
}
