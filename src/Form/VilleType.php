<?php

namespace App\Form;

use App\Entity\Ville;
use App\Repository\VilleRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VilleType extends AbstractType
{
    static private VilleRepository $villeRepository;

    public function __construct(VilleRepository $villeRepository)
    {
        VilleType::$villeRepository=$villeRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('idVille',HiddenType::class,[
                'attr'=>
                [
                    'value'=>VilleType::$villeRepository->count()+1
                ]
            ])
            ->add('nomVille')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ville::class,
        ]);
    }
}
