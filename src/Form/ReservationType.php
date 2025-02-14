<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Reservation;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateBegin', null, [
                'widget' => 'single_text',
                'label' => 'Date de réservation',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('books', EntityType::class, [
                'class' => Book::class,
                'choice_label' => 'name',
                'label' => 'Livres réservés',
                'multiple' => true,
                'attr' => [
                    'class' => 'form-select'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
