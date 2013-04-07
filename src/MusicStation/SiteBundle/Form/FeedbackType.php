<?php

namespace MusicStation\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\True;

class FeedbackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'label' => 'Name and Surname:',
                'constraints' => array(
                    new NotBlank(array(
                        'message' => 'Enter your name and surname'
                    ))
                )
            ))
            ->add('email', 'email', array(
                'label' => 'Email:',
                'constraints' => array(
                    new NotBlank(array(
                        'message' => 'Enter an email address'
                    )),
                    new Email(array(
                        'message' => 'Enter a valid email address'
                    ))
                )
            ))
            ->add('message', 'textarea', array(
                'label' => 'Tell us how to improve:',
                'constraints' => array(
                    new NotBlank(array(
                        'message' => 'Enter a message'
                    ))
                )
            ))
            ->add('privacy', 'checkbox', array(
                'constraints' => array(
                    new True(array(
                        'message' => 'You must accept the privacy terms and conditions'
                    ))
                )
            ))
        ;
    }

    public function getName()
    {
        return 'musicstation_feedback_type';
    }
}
