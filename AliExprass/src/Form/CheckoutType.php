<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CheckoutType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $options['user']; // Recuperation des informations de user pour mettre dans le formulaire 
        $builder
            ->add(
                'address',
                EntityType::class,
                [
                    'class' => Address::class,
                    'required'  => true,
                    'choices'  => $user->getAddresses(),
                    'multiple' => false,
                    'expanded' => true

                ]
            )
            ->add(
                'carrier',
                EntityType::class,
                [
                    'class' => Address::class,
                    'required'  => true,
                    'multiple' => false,
                    'expanded' => true

                ]
            )
            ->add('information');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
