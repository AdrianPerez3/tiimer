<?php

namespace App\Form;

use App\Entity\Tiimer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TiimerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('startTime', TimeType::class, [
                'with_seconds' => true,
                'widget' => 'single_text',
                'row_attr' => ['class' => 'workDur p-2 mx-1', 'id' => 'startTime']


            ])
            ->add('endTime', TimeType::class, [
                'with_seconds' => true,
                'widget' => 'single_text',
                'row_attr' => ['class' => 'workDur p-2 mx-1', 'id' => 'endTime']

            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'input'  => 'datetime_immutable',
                'row_attr' => ['class' => 'workDur p-2 mx-1', 'id' => 'date']

            ])
            ->add('description', TextType::class, [
                'row_attr' => ['class' => 'workDur p-2 mx-1', 'id' => 'description']
            ])
            ->add('Submit', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary d-block w-100']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tiimer::class,
        ]);
    }
}
