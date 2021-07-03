<?php

namespace App\Form;

use App\Entity\DisciplinaProfessoreTurma;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DisciplinaProfessoreTurmaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Professore')
            ->add('Disciplina')
            ->add('Turma')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DisciplinaProfessoreTurma::class,
        ]);
    }
}
