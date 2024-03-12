<?php

namespace App\Form;

use App\Entity\Cliente;
use App\Entity\Habitacion;
use App\Entity\Reserva;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservaFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('noches')
            ->add('cliente', EntityType::class, [
                'class' => Cliente::class,
                'choice_label' => 'id',
            ])
            ->add('habitacion', EntityType::class, [
                'class' => Habitacion::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reserva::class,
        ]);
    }
}
