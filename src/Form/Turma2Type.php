<?php

namespace App\Form;

use App\Entity\Turma;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Turma2Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome_turma')
            ->add('delegado')
            ->add('email', EmailType::class)
            ->add('phone')
            ->add('anoAcademico')
            ->add('semestre')
            //->add('estudiantes')
            //->add('disciplinas')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Turma::class,
        ]);
    }
}
