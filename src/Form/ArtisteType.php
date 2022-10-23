<?php

namespace App\Form;

use App\Entity\Artiste;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArtisteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label'=>"Nom de l'artiste",
                'help' => "Ex : Vatiroi",
                'attr'=>[
                    'placeholder'=>"Saisir le nom de l'artiste"

                ]
            ])
            ->add('description', CKEditorType::class, [
                "config_name"=>"config_complete"

            ])

            ->add('site', UrlType::class)

            ->add('image', TextType::class)

            ->add('type', ChoiceType::class, [
                "choices"=>[
                    "solo"=>0,
                    "groupe"=>1
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Artiste::class,
        ]);
    }
}
