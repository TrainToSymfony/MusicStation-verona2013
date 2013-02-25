<?php

namespace MusicStation\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Shout
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="MusicStation\UserBundle\Entity\ShoutRepository")
 */
class Shout
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text")
     */
    private $message;

    /**
     * @ORM\ManyToOne(targetEntity="MusicStation\UserBundle\Entity\Artist", inversedBy="shouts", cascade={"persist"})
     * @ORM\JoinColumn(name="artist_id", referencedColumnName="id")
     */
    protected $artist;

    /****************************************************************************************************
     * CUSTOM FUNCTIONS
     ***************************************************************************************************/

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
     * Set message
     *
     * @param string $message
     * @return Shout
     */
    public function setMessage($message)
    {
        $this->message = $message;
    
        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set artist
     *
     * @param \MusicStation\UserBundle\Entity\Artist $artist
     * @return Shout
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