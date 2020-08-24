<?php

namespace App\Form;

use App\Entity\EmDenomMapTodoV2;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModifTodoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Denomination', TextType::class,['attr'=> ['disabled' => true], 'label_format' => 'Produit'])
            ->add('Nbr', TextType::class,['attr'=> ['disabled' => true], 'label_format' => 'Effectif'])
            ->add('CIS', TextType::class,['label_format' => 'Code CIS', 'required' => false])
            ->add('Label', TextType::class,['label_format' => 'Label', 'required' => false])
            ->add('BN_Label', TextType::class,['label_format' => 'BN Label'])
            ->add('ATC7', TextType::class,['label_format' => 'Code ATC 7', 'required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EmDenomMapTodoV2::class,
        ]);
    }
}
