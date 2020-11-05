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
            ->add('dateDeDebut')
            ->add('duree')
            ->add('dateCloture')
            ->add('nbInscriptionMax')
            ->add('descriptionInfos')
            ->add('etatSortie')
            ->add('urlPhoto')
            ->add('organisateur')
            ->add('lieux_no_lieux')
            ->add('etats_no_etat')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sorties::class,
        ]);
    }
}
