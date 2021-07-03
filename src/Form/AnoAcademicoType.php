<?php

namespace App\Form;

use App\Entity\AnoAcademico;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnoAcademicoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome_ano_academico', ChoiceType::class, ['label'=>'Ano Acadêmico',
                'choices'  => array(
                    '1º' => '1º',
                    '2º' => '2º',
                    '3º' => '3º',
                    '4º' => '4º',
                    '5º' => '5º',
                )
            ])
            ->add('curso')
        ;
    }






    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AnoAcademico::class,
        ]);
    }
}
