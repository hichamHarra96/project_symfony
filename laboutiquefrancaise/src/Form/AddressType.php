<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[
                'label'=>"Quel nom souhaitez-vous donnez à votre adresse ?",
                'attr'=>[
                    'placeholder'=>"Nommez votre addresse"
                ]

            ])
            ->add('firstname',TextType::class,[
                'label'=>"Votre prénom",
                'attr'=>[
                    'placeholder'=>"Votre prénom"
                ]

            ])
            ->add('lastname',TextType::class,[
                'label'=>"Votre nom",
                'attr'=>[
                    'placeholder'=>"Votre nom"
                ]

            ])
            ->add('company',TextType::class,[
                'label'=>"Nom de votre companie",
                'attr'=>[
                    'placeholder'=>"(Facultatif) Nom de votre companie"
                ]

            ])
            ->add('adress',TextType::class,[
                'label'=>"Votre addresse",
                'attr'=>[
                    'placeholder'=>"num, Rue ..."
                ]

            ])
            ->add('postal',TextType::class,[
                'label'=>"Votre code postal",
                'attr'=>[
                    'placeholder'=>"Votre code postal"
                ]

            ])
            ->add('city',TextType::class,[
                'label'=>"Votre ville",
                'attr'=>[
                    'placeholder'=>"Votre ville"
                ]

            ])
            ->add('country',CountryType::class,[
                'label'=>"Votre pays",
                'attr'=>[
                    'placeholder'=>"Vote pays"
                ]

            ])
            ->add('phonr',TelType::class,[
                'label'=>"Vote numéro de téléphone",
                'attr'=>[
                    'placeholder'=>"Vote numéro de téléphone"
                ]

            ])
            ->add('submit',SubmitType::class, [
                'label'=>'Ajouter mon adresse',
                'attr'=>[
                    'class'=>'btn-block btn-info'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
