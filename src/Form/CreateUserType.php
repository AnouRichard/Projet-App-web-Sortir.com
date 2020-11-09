<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\Participants;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo', TextType::class)
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('telephone', TextType::class)
            ->add('mail', TextType::class)
            ->add('motDePasse', TextType::class)
        /*    ->add("confirmation", TextType::class, ['mapped' => false]) */
            ->add('campus', EntityType::class,[
            'class'  => Campus::class , "choice_label"=>'nom_campus'
        ])
        /*   ->add('photo', FileType::class, ['label' => 'Photo']) */
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participants::class,
        ]);
    }
}
