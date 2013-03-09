<?php

namespace MusicStation\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="MusicStation\UserBundle\Entity\Artist", cascade={"persist"})
     * @ORM\JoinColumn(name="artist_id", referencedColumnName="id")
     */
    protected $artist;

    /****************************************************************************************************
     * CUSTOM FUNCTIONS
     ***************************************************************************************************/

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /****************************************************************************************************
     * GETTERS AND SETTERS
     ***************************************************************************************************/

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set artist
     *
     * @param \MusicStation\UserBundle\Entity\Artist $artist
     * @return User
     */
    public function setArtist(\MusicStation\UserBundle\Entity\Artist $artist = null)
    {
        $this->artist = $artist;
    
        return $this;
    }

    /**
     * Get artist
     *
     * @return \MusicStation\UserBundle\Entity\Artist 
     */
    public function getArtist()
    {
        return $this->artist;
    }
}