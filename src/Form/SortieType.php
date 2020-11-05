<?php

namespace App\Form;

use App\Entity\Sorties;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,[
               'attr'=>['class'=>'form-control' ],
                'label'=>'Nom'
            ])
            ->add('dateDeDebut',TextType::class,[
                'attr'=>['class'=>'form-control' ],
                'label'=>'Date et heure de la sortie'
            ])
            ->add('duree',TextType::class,[
                'attr'=>['class'=>'form-control' ],
                'label'=>'Duree'
            ])
            ->add('dateCloture',TextType::class,[
                'attr'=>['class'=>'form-control' ],
                'label'=>'Date limite d inscription'
            ])
            ->add('nbInscriptionMax',TextType::class,[
                'attr'=>['class'=>'form-control' ],
                'label'=>'Nombre de places'
            ])
            ->add('descriptionInfos',TextType::class,[
                'attr'=>['class'=>'form-control' ],
                'label'=>'Description et infos'
            ])
            ->add('etatSortie',TextType::class,[
                'attr'=>['class'=>'form-control' ],
                'label'=>'EtatSortie'
            ])
            ->add('urlPhoto',TextType::class,[
                'attr'=>['class'=>'form-control' ],
                'label'=>'Photo'
            ])
            ->add('organisateur',TextType::class,[
                'attr'=>['class'=>'form-control' ],
                'label'=>'Organisateur'
            ])
            ->add('lieux_no_lieux',TextType::class,[
                'attr'=>['class'=>'form-control' ],
                'label'=>'Lieux'
            ])
            ->add('etats_no_etat',TextType::class,[
                'attr'=>['class'=>'form-control' ],
                'label'=>'Etat'
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
