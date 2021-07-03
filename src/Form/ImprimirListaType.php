<?php

namespace App\Form;

use App\Entity\Disciplina;
use App\Entity\Semestre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImprimirListaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome_discilpina',EntityType::class, ['class' => Disciplina::class])
            //->add('cant_horas')
            //->add('semestre',EntityType::class, ['class' => Semestre::class])
            ->add('Listar', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Disciplina::class,
        ]);
    }
}
