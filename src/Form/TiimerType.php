<?php

namespace App\Form;

use App\Entity\Tiimer;
use Doctrine\DBAL\Types\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TiimerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('startTime', TimeType::class, [
                'input'  => 'datetime',
                'widget' => 'choice',
            ])
            ->add('endTime', TimeType::class, [
                'input'  => 'datetime',
                'widget' => 'choice',
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
