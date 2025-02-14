<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Reservation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType; 
use Symfony\Component\Validator\Constraints\File; 

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'attr' => ["class" => "form-control"],
                'label' => 'Titre'
            ])
            ->add('summary', null, [
                'attr' => ["class" => "form-control"],
                'label' => 'Résumé'
            ])
            ->add('author', null, [
                'attr' => ["class" => "form-control"],
                'label' => 'Auteur'
            ])
            ->add('stock', null, [
                'attr' => ["class" => "form-control"]
            ])
            ->add(
                'image',
                FileType::class,
                [
                    'label' => 'Image de couverture',
                    'mapped' => false,
                    'required' => false,
                    'constraints' => [
                        new File([
                            'maxSize' => '5000k',
                            'mimeTypes' => ['image/*',],
                            'mimeTypesMessage' => 'Image trop lourde',
                        ])
                    ],
                    'attr' => ["class" => "form-control"]
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
