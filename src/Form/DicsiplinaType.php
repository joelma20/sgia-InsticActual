<?php

namespace App\Form;

use App\Entity\Disciplina;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DicsiplinaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome_discilpina')
            ->add('cant_horas')
            ->add('semestre')
            //->add('turmaas')
            //->add('nome')
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
