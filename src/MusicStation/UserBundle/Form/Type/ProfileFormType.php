<?php

namespace MusicStation\UserBundle\Form\Type;

use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

use MusicStation\UserBundle\Entity\Artist;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\Validator\Constraint\UserPassword;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\True;
use Symfony\Component\Validator\Constraints\Collection;

use MusicStation\UserBundle\Form\ArtistType;

class ProfileFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add custom fields
        $builder
            ->add('artist', new ArtistType())
        ;
    }

    public function getName()
    {
        return 'musicstation_user_profile';
    }
}