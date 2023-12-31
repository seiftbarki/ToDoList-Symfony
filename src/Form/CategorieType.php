<?php

namespace App\Form;

use App\Entity\Categorie;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('namecategorie',TextType::class,[
                "label"=> "Votre catégorie",
                "label_attr"=>["class"=>"fs-14 text-black fw-medium mb-0"],
                "attr"=>["class"=>"form-control form--control","placeholder"=>"saisir votre categorie"]
                
            ])
            ->add("submit",SubmitType::class,[
                "label"=> "Publier votre question",
                "attr"=>["class"=>"btn theme-btn"]
               
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class,
        ]);
    }
}
