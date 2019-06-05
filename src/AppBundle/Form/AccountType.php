<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AccountType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('resourceId', TextType::class, array(
                'label' => ' ',
                'attr'=>array('placeholder'=> 'ResourceId'),
            ))
            ->add('bicFi', TextType::class, array(
                'label' => ' ',
                'attr'=>array('placeholder'=> 'BIC'),
            ))
            ->add('name', TextType::class, array(
                'label' => ' ',
                'attr'=>array('placeholder'=> 'Nom'),
            ))
            ->add('accountUse', TextType::class, array(
                'label' => ' ',
                'attr'=>array('placeholder'=> 'Utilisation du compte'),
            ))
            ->add('cashAccountType', TextType::class, array(
                'label' => ' ',
                'attr'=>array('placeholder'=> 'cashAccountType'),
            ))
            ->add('iban', TextType::class, array(
                'label' => ' ',
                'attr'=>array('placeholder'=> 'Iban'),
            ))
            ->add('currency', TextType::class, array(
                'label' => ' ',
                'attr'=>array('placeholder'=> 'Devise'),
            ))
            ->add('psuStatus', TextType::class, array(
                'label' => ' ',
                'attr'=>array('placeholder'=> 'Statut'),
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Envoyer'
            ));


    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Account'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_account';
    }


}
