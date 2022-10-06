<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ModifyInformationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email', EmailType::class, [
            'disabled' => true,
            'label' => 'Mon adresse email'
        ])
        ->add('firstname', TextType::class, [
            'disabled' => true,
            'label' => 'Mon prénom'
        ])
        ->add('name', TextType::class, [
                'disabled' => true,
                'label' => 'Mon nom'
        ])

        ->add('tel', TelType::class, [
            'label' => 'Un numéro de téléphone',
            'attr' => [
                'placeholder' => 'Saisissez votre numéro de téléphone'
            ]
        ])
        ->add('email', EmailType::class, [
            'label' => 'Votre email',
            'constraints' => new Length([
                'min' => 5,
                'max' => 60,
            ]),
            'attr' => [
                'placeholder' => 'Saisissez votre email'
            ]
        ])
        ->add('address', TextType::class, [
            'label' => 'Votre adresse',
            'constraints' => new Length([
                'max' => 255,
            ]),
            'attr' => [
                'placeholder' => 'Saisissez votre rue et votre numéro'
            ]
        ])
        ->add('city', TextType::class, [
            'label' => 'Votre ville',
            'attr' => [
                'placeholder' => 'Saisissez votre ville'
            ]
        ])
        ->add('postal', TextType::class, [
            'label' => 'Votre code postal',
            'attr' => [
                'placeholder' => 'Saisissez votre code postal'
            ]
        ])
        ->add('country', CountryType::class, [
            'label' => 'Votre pays',
            'attr' => [
                'placeholder' => 'Choisissez votre pays'
            ]
        ])
        ->add('company', TextType::class, [
            'label' => 'Votre société',
            'attr' => [
                'placeholder' => '(facultatif) Saisissez votre société'
            ]
        ])
        ->add('old_password', PasswordType::class, [
            'label' => 'Mon mot de passe',
            'mapped' => false,
            'attr' => [
                'placeholder' => 'Veuillez saisir votre mot de passe actuel'
                ]
        ])
        ->add('new_password', RepeatedType::class,[
            'type' => PasswordType::class,
            'mapped' => false,
            'invalid_message' => 'Le mot de passe et la confirmation doivent être identique',
            'constraints' => new Length([
                'min' => 8,
                'max' => 60,
            ]),
            'label'=> 'Mon nouveau mot de passe',
            'required' => true,
            'first_options' => [
                'label' => 'Mon nouveau mot de passe',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre mot de passe'
                    ]
            ],
            'second_options' => [
                'label' => 'confirmation du nouveau mot de passe',
                'attr' => [
                    'placeholder' => 'Merci de confirmer votre nouveau mot de passe'
                    ]
            ]
        ])
        ->add('submit', SubmitType::class,[
            'label' => 'Mettre à jour',
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
