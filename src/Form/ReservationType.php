<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, ['attr'=> ['class'=>'col-6']])
            ->add('lastname', TextType::class, ['attr'=> ['class'=>'col-6']])
            ->add('phone', TelType::class, ['attr'=> ['class'=>'col-6']])
            ->add('mealType', ChoiceType::class, [
                'choices' => [
                    'Petit-déjeuner' => 'Petit-déjeuner',
                    'Déjeuner' => 'Déjeuner', 
                    'Dîner' => 'Dîner'],
                'attr'=> ['class'=>'col-6']])
            ->add('places', NumberType::class, [
                'attr'=> ['class'=>'col-6']
                ])
            ->add('dateArrival', DateTimeType::class, ['attr'=> ['class'=>'col-8']])
            ->add('message', TextareaType::class, ['attr'=> ['rows'=>'5']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
