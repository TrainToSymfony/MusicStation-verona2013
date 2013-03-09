<?php

namespace MusicStation\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Collection;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add custom fields
        $builder
            ->add('artist_name', 'text', array(
                'mapped' => false,
                'constraints' => new NotNull(
                    array('message' => 'Invalid artist name')
                )
            ))
            ->add('artist_bio', 'textarea', array(
                'mapped' => false
            ))
        ;
    }

    public function getName()
    {
        return 'musicstation_user_registration';
    }
}