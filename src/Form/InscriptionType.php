<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',null,[
               "label" =>"Nom d'utilisateur",
               "label_attr"=>["class"=>"fs-14 text-black fw-medium lh-18"],
               "attr"=>["class"=>"form-control form--control","placeholder"=>"Votre nom d'utilisateur" ]
            ])
            ->add('email',null,[
                "label" =>"email",
                "label_attr"=>["class"=>"fs-14 text-black fw-medium lh-18"],
                "attr"=>["class"=>"form-control form--control","placeholder"=>"Votre email" ]
             ])
            ->add('password',PasswordType::class,[
                "label" =>"votre mot de passe ",
                "label_attr"=>["class"=>"fs-14 text-black fw-medium lh-18"],
                "attr"=>["class"=>"form-control form--control","placeholder"=>"Votre mot de passe" ]
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
