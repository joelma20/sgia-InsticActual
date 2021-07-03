<?php

namespace App\Form;

use App\Entity\Disciplina;
use App\Entity\Estudante;
use App\Entity\Turma;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ListaTurmaEstudianteDisciplinaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome_turma', EntityType::class, ['class' => Turma::class])


            //->add('disciplinas', EntityType::class, ['class' => Disciplina::class])
            //->add('estudiantes', EntityType::class, ['class' => Estudante::class])

            ->add('Guardar', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Turma::class,
        ]);
    }
}
