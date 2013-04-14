<?php

namespace MusicStation\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Validator\Constraints\NotNull;

class ArtistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'constraints' => new NotNull(
                    array('message' => 'Invalid artist name')
                )
            ))
            ->add('image')
            ->add('bio')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MusicStation\UserBundle\Entity\Artist'
        ));
    }

    public function getName()
    {
        return 'musicstation_userbundle_artisttype';
    }
}
