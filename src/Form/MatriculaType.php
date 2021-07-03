<?php

namespace App\Form;

use App\Entity\AnoAcademico;
use App\Entity\Curso;
use App\Entity\Estudante;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatriculaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome_estudiante')
            ->add('FotografiaFile', FileType::class,
                ['required' => false,
                    'label' => 'Artivo',
                ])
            ->add('NumProcesso')
            ->add('email')
            ->add('telefone')
            ->add('BI')
            ->add('DataNascimento', DateType::class, ['widget'=>'single_text'])
            ->add('Discapacidade')
            ->add('anoAcademico',EntityType::class,['class'=>AnoAcademico::class,
                'query_builder' => function($repository){return $repository->createQueryBuilder('AnoAcademico')->where('AnoAcademico.nome_ano_academico = 1');}
                ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Estudante::class,
        ]);
    }
}
