<?php

namespace App\Form;

use App\Entity\Sorties;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CreateSortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,[
                'attr'=>['class'=>'form-control' ],
                'label'=>'Nom'
            ])
            ->add('dateDeDebut',DateTimeType::class,[
                'attr'=>['class'=>'form-control' ],
                'label'=>'Date et heure de la sortie'
            ])
            ->add('duree',ChoiceType::class,[
                'attr'=>['class'=>'form-control' ],
                'label'=>'Duree'
            ])
            ->add('dateCloture',DateType::class,[
                'attr'=>['class'=>'form-control' ],
                'label'=>'Date limite d inscription'
            ])
            ->add('nbInscriptionMax',NumberType::class,[
                'attr'=>['class'=>'form-control' ],
                'label'=>'Nombre de places'
            ])
            ->add('descriptionInfos',TextareaType::class,[
                'attr'=>['class'=>'form-control' ],
                'label'=>'Description et infos'
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sorties::class,
        ]);
    }
}
