<?php

namespace MusicStation\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('location')
            ->add('startDate', 'datetime', array(
                'label' => 'Start date',
                'widget' => 'single_text',
                'format' => 'yyyy/MM/dd HH:mm:ss'
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MusicStation\UserBundle\Entity\Event'
        ));
    }

    public function getName()
    {
        return 'musicstation_userbundle_eventtype';
    }
}
