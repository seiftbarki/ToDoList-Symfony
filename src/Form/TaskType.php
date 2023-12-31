<?php

namespace App\Form;

use App\Entity\Task;
use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nametask',TextType::class,[
            "label"=> "Votre tache",
            "label_attr"=>["class"=>"fs-14 text-black fw-medium mb-0"],
            "attr"=>["class"=>"form-control form--control","placeholder"=>"saisir votre tache"]
            
        ])
        ->add('dueDate',DateType::class,[
            "label"=> "dueDate",
            "label_attr"=>["class"=>"fs-14 text-black fw-medium mb-0"],
            "attr"=>["class"=>"form-control form--control"]
            
        ])
        ->add("submit",SubmitType::class,[
            "label"=> "Publier votre tache",
            "attr"=>["class"=>"btn theme-btn"]
           
            
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
