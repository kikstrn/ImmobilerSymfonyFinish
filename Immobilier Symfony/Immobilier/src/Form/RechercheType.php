<?php

namespace App\Form;

use App\Entity\Localisation;
use App\Entity\Recherche;
use App\Entity\TypeLogement;
use App\Entity\Vente;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prix', TextType::class, array(
                'label' => 'Prix max (en €)',
                'required' => false
            ))
            ->add('nombrePiece', TextType::class, array(
                'label' => 'Nombre de pièces',
                'required' => false
            ))
            ->add('surfaceTotale', TextType::class, array(
                'label' => 'Surface Totale (en m²)',
                'required' => false
            ))
            ->add('nomVente',  EntityType::class,array(
                'class' => Vente::class,
                'required' => false,
                'choice_label' => 'nomVente'
            ))
            ->add('typeLogement',  EntityType::class,array(
                'class' => TypeLogement::class,
                'required' => false,
                'choice_label' => 'nomTypeLogement'
            ))
            ->add('localisation',  EntityType::class,array(
                'class' => Localisation::class,
                'required' => false,
                'choice_label' => 'nomLocalisation',))
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recherche::class,
            'translation_domain' => 'forms'
        ]);
    }
}
