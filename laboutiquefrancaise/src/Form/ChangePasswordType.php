<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    { 
        $builder
            ->add('email',EmailType::class,['disabled'=>true, 'label'=>"Email"])
            ->add('firstname',TextType::class,['disabled'=>true,'label'=>"Prénom"])
            ->add('lastname',TextType::class,['disabled'=>true,'label'=>"Nom"])
            ->add('old_password',PasswordType::class,['label'=>"Mot de passe actuel",  'mapped'=>false,
            'attr'=>['placeholder'=>"Veuillez saisir votre mot de passse actuel"]
            ])
            ->add('new_password',RepeatedType::class,[
                'type'=>PasswordType::class,
                'mapped'=>false,
                'invalid_message'=>"mots de passe sont pas identiques!",
                'label'=>"nouveau mot de passe",
                'required'=>true,
                'first_options'=>['label'=>"Nouveau de passe",'attr'=>['placeholder'=>"Merci de saisir votre nouveau mot de passe"]],
                'second_options'=>['label'=>"Confirmez votre nouveau mot de passe",'attr'=>['placeholder'=>"Merci de confirmez votre nouveau mot de passe"]],
                ])
            ->add('submit',SubmitType::class,['label'=>"Modifier"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
