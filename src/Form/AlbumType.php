<?php

namespace App\Form;

use App\Entity\Album;
use App\Entity\Style;
use App\Entity\Artiste;
use App\Form\MorceauType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AlbumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label'=>"Nom de l'album",
                'help' => "Ex : Deux Frères",
                'attr'=>[
                    'placeholder'=>"Saisir le nom de l'album"
                ]
            ])
            ->add('date', IntegerType::class)
            ->add('image', TextType::class)
            ->add('artiste', EntityType::class, [
                'class' => Artiste::class,
                'choice_label' => 'nom'
            ])
            ->add('styles', EntityType::class, [
                'class'=> Style::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'by_reference' => false,
                'attr'=>[
                    'class'=>"selectStyles"
                ]
            ])
            ->add('morceaux', CollectionType::class, [
                'entry_type'=> MorceauType::class
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Album::class,
        ]);
    }
}
