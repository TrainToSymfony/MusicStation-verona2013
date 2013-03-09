<?php

namespace MusicStation\UserBundle\Form\Handler;

use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Form\Handler\RegistrationFormHandler as BaseHandler;

use MusicStation\UserBundle\Entity\Artist;

class RegistrationFormHandler extends BaseHandler
{
    /**
     * @param boolean $confirmation
     */
    protected function onSuccess(UserInterface $user, $confirmation)
    {
        parent::onSuccess($user, $confirmation);

        /**
         * add Artist entity
         */
        $artist = new Artist();
        $artist->setName(
            $this->form->get('artist_name')->getData()
        );
        $artist->setBio(
            $this->form->get('artist_bio')->getData()
        );
        $artist->setUser($user);

        $user->setArtist($artist);

        // update user
        $this->userManager->updateUser($user);
    }

}