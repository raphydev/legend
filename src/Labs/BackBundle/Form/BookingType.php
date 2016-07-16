<?php

namespace Labs\BackBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'label' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ))
            ->add('lieu', TextType::class, array(
                'label' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ))
            ->add('name', TextType::class, array(
                'label' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ))
            ->add('date_res',DateType::class, array(
                'widget' => 'single_text',
                'html5'  => false,
                'label'  => false,
                'attr' => ['class' => 'js-datepicker form-control']
            ))
            ->add('packages',EntityType::class, array(
                'label' => false,
                'class' => 'LabsBackBundle:Packages',
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control']
            ))
            ->add('status', ChoiceType::class, array(
                'label' => false,
                'choices' => array(
                    'OUI' => true,
                    'NON' => false,
                )
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Labs\BackBundle\Entity\Booking'
        ));
    }
}
