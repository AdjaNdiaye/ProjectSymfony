<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('prix')
            ->add('image')
            // ->add('date_add')
            ->add('date_add', DateType::class,[
                'widget'=> 'single_text',
            ])
            ->add('idcategory'
            ,EntityType::class,
             [
                'class'=>Category::class,
                'choice_label'=>'nom',
                 'placeholder'=>'choisir une categorie',
                 'label' =>'idcategorie'
            ]
             )
            
           ->add('save', SubmitType::class)
          
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
