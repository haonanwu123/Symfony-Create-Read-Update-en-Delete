<?php

namespace App\Form;

use App\Entity\Autos;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('model',TextType::class)
            ->add('type',TextType::class)
            ->add('kleur',TextType::class)
            ->add('gewicht',TextType::class)
            ->add('prijs',TextType::class)
            ->add('voorraad',TextType::class)
            ->add('update',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Autos::class,
        ]);
    }
}
