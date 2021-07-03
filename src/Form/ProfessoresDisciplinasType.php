<?php

namespace App\Form;

use App\Entity\Disciplina;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfessoresDisciplinasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomeDisciplina',null,['label'=>'Disciplina'])
            ->add('turmaas',null,['label'=>'Turmas'])
            ->add('nome',null,['label'=>'Professor'])
           // ->add('DisciplinaCondicionante')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Disciplina::class,
        ]);
    }
}
