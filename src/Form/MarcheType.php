<?php

namespace App\Form;

use App\Entity\Marche;
use App\Entity\Ville;
use App\Repository\MarcheRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MarcheType extends AbstractType
{
    //* */
    static private MarcheRepository $marcheRepository;

    public function __construct(MarcheRepository $marcheRepository)
    {
        MarcheType::$marcheRepository= $marcheRepository;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $nbr=MarcheType::$marcheRepository->findAll();
        $builder
            ->add('idMarche',HiddenType::class,
            [
                'attr'=>[
                    'value'=>count($nbr)+1
                    ]
            ]
            )
            ->add('nomMarche',TextType::class,
            [
                'attr'=>[
                    'placeholder'=>'Nom du marché',
                    'class'=>'form-control rounded-0',
                    'id'=>'nomMarche'
                ]
            ]
            )
            ->add('description',TextareaType::class,
            [
                'attr'=>[
                    'placeholder'=>'Nom du groupe',
                    'class'=>'form-control rounded-0',
                    'id'=>'description'
                ]
            ])
            ->add('capacite',TextType::class,
            [
                'attr'=>[
                    'placeholder'=>'Capacité du marché',
                    'class'=>'form-control rounded-0',
                    'id'=>'capacite'
                ]
            ])
            ->add('adresse',TextType::class,
            [
                'attr'=>[
                    'placeholder'=>'Adresse',
                    'class'=>'form-control rounded-0',
                    'id'=>'adresse'
                ]
            ])
            ->add('telephone',TextType::class,
            [
                'attr'=>[
                    'placeholder'=>'Téléphone',
                    'class'=>'form-control rounded-0',
                    'id'=>'capacite'
                ]
            ])
            ->add('image',TextType::class,
            [
                'attr'=>[
                    'class'=>'form-control rounded-0',
                    'id'=>'image'
                ]
            ])
            ->add('idVille', EntityType::class, [
                'class' => Ville::class,
                'choice_label' => 'nomVille',
                'attr'=>[
                    'placeholder'=>'Sélectionner une ville',
                    'class'=>'form-control rounded-0',
                    'id'=>'ville'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Marche::class,
        ]);
    }
}
